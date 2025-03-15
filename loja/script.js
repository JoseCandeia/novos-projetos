document.addEventListener("DOMContentLoaded", () => {
    // Array que armazenará os itens do carrinho
    let cart = [];
    
    // Cache dos elementos do DOM
    const cartCountEl = document.querySelector(".cart p");
    const sidebar = document.querySelector(".barra-lateral");
    const emptyMsg = sidebar.querySelector(".item-carrinho-vazio");
    const rodape = sidebar.querySelector(".rodape");
  
    // Mapeamento dos IDs de produtos para suas imagens
    const productImages = {
      "1": "chips-160417_640.png",
      "2": "arroz.png",
      "3": "coca.png",
      "4": "cream_crakcker.png"
    };
  
    // Retorna a imagem correta para um dado ID de produto
    const getImageForProduct = id => productImages[id] || "";
  
    // Calcula a contagem total de itens e o valor total do carrinho
    const calculateCartTotals = () => {
      return cart.reduce(
        (acc, item) => {
          acc.totalCount += item.quantity;
          acc.totalPrice += item.price * item.quantity;
          return acc;
        },
        { totalCount: 0, totalPrice: 0 }
      );
    };
  
    // Atualiza a interface do carrinho (quantidade, itens e total)
    const updateCartDisplay = () => {
      const { totalCount, totalPrice } = calculateCartTotals();
  
      // Atualiza a contagem de itens no cabeçalho
      cartCountEl.textContent = totalCount;
  
      // Remove itens antigos adicionados dinamicamente
      sidebar.querySelectorAll(".item-carrinho.dynamic").forEach(el => el.remove());
  
      // Exibe mensagem se o carrinho estiver vazio
      if (cart.length === 0) {
        emptyMsg.style.display = "block";
      } else {
        emptyMsg.style.display = "none";
        // Insere cada item do carrinho antes da área de rodapé
        cart.forEach(item => {
          const div = document.createElement("div");
          div.classList.add("item-carrinho", "dynamic");
          div.innerHTML = `
            <div class="linha-da-imagem">
              <img src="img/${getImageForProduct(item.id)}" alt="" class="img-carrinho">
            </div>
            <p>${item.name} (x${item.quantity})</p>
            <h2>R$ ${(item.price * item.quantity).toFixed(2).replace('.', ',')}</h2>
            <form class="remove-form" style="display:inline;">
              <input type="hidden" name="id_produto" value="${item.id}">
              <button type="submit" style="border:none; background:none;">
                <i class="fa fa-trash-o"></i>
              </button>
            </form>
          `;
          rodape.parentNode.insertBefore(div, rodape);
        });
      }
  
      // Atualiza o total geral no rodapé
      const totalEl = rodape.querySelector("h2");
      totalEl.textContent = "R$ " + totalPrice.toFixed(2).replace('.', ',');
    };
  
    // Função para adicionar um item ao carrinho
    const addToCart = form => {
      const id = form.querySelector("input[name='id_produto']").value;
      const name = form.querySelector(".titulo p").textContent.trim();
      let priceText = form.querySelector(".titulo h2").textContent.trim();
      priceText = priceText.replace("R$", "").trim().replace(",", ".");
      const price = parseFloat(priceText);
  
      // Se o produto já existe, incrementa a quantidade; caso contrário, adiciona-o
      const existing = cart.find(item => item.id === id);
      if (existing) {
        existing.quantity++;
      } else {
        cart.push({ id, name, price, quantity: 1 });
      }
      updateCartDisplay();
    };
  
    // Intercepta o envio dos formulários de adição ao carrinho
    document.querySelectorAll("form").forEach(form => {
      if (form.querySelector("button[name='addcarrinho']")) {
        form.addEventListener("submit", e => {
          e.preventDefault();
          addToCart(form);
        });
      }
    });
  
    // Intercepta a remoção dos itens do carrinho via delegação de eventos
    sidebar.addEventListener("submit", e => {
      const removeForm = e.target.closest("form.remove-form");
      if (removeForm) {
        e.preventDefault();
        const id = removeForm.querySelector("input[name='id_produto']").value;
        cart = cart.filter(item => item.id !== id);
        updateCartDisplay();
      }
    });
  
    // Inicializa a exibição do carrinho
    updateCartDisplay();
  });
  