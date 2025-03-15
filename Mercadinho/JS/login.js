let tentativas = 0;

document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Impede o envio padrão do formulário

    const nome = document.getElementById("nome").value;
    const senha = document.getElementById("senha").value;
    const erroMensagem = document.querySelector(".p"); 
    const senhaErrada = document.getElementById("senhaErrada");
    const novaSenhaDiv = document.getElementById("novaSenha");

    if (nome === "" || senha === "") {
        erroMensagem.textContent = "Preencha todos os campos!";
        erroMensagem.style.display = "block";
        return;
    }

    // Envia os dados para o PHP via fetch
    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `nome=${encodeURIComponent(nome)}&senha=${encodeURIComponent(senha)}`
    })
    .then(response => response.json()) // Converte a resposta em JSON
    .then(data => {
        if (data.success) {
            alert("Login confirmado!");
            window.location.href = "../BANCO/painel.php"; // Redireciona ao painel
        } else {
            tentativas++;

            if (tentativas >= 3) {
                novaSenhaDiv.classList.add("show");
                senhaErrada.style.display = "none";
                erroMensagem.style.display = "block";
                erroMensagem.textContent = "Muitas tentativas! Redefina sua senha.";
            } else {
                erroMensagem.style.display = "block";
                erroMensagem.textContent = "Usuário ou senha incorretos! Tentativas restantes: " + (3 - tentativas);
            }
        }
    })
    .catch(error => console.error("Erro na requisição:", error));
});

function newsenha() {
    const senha = document.getElementById("novasenha").value;

    if (senha === "1234") {  
        alert("Senha alterada com sucesso!!!");
        window.location.href = "login.php";
    } else {
        alert("Erro ao alterar a senha.");
    }
}
