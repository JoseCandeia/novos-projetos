
// PRIMEIRA SESSAO

const imgPromo = document.getElementById('img');


function setaRight() {
    if (imgPromo.src.includes('promocao1.png')) {
        imgPromo.src = 'img/promocao2.png';
        document.getElementById('radio2').checked = true;
    
    } else if (imgPromo.src.includes('promocao2.png')) {
        imgPromo.src = 'img/promocao3.png';
        
        document.getElementById('radio3').checked = true;
    } else {
        imgPromo.src = 'img/promocao1.png';
        document.getElementById('radio1').checked = true;
        
    }
}


function setaLeft() {
    if (imgPromo.src.includes('promocao1.png')) {
        imgPromo.src = 'img/promocao3.png';
        document.getElementById('radio3').checked = true;
    } else if (imgPromo.src.includes('promocao3.png')) {
        imgPromo.src = 'img/promocao2.png';
        document.getElementById('radio2').checked = true;
    } else {
        imgPromo.src = 'img/promocao1.png';
        document.getElementById('radio1').checked = true;
    }
}


// SEGUNDA SESSAO/ SESSAO DE PRODUTOS





// SESSAO INVISIVEL
const chips = document.getElementById('invisivel');

function invisible() {
    
    chips.style.display = 'flex';
    chips.style.opacity = 0; 
    chips.style.position = 'fixed'; 
    chips.style.top = '50%';  
    chips.style.left = '50%'; 
    chips.style.transform = 'translate(-50%, -50%)'; 
    chips.style.zIndex = 1000; 
    // Transição suave
    setTimeout(() => {
        chips.style.transition = 'opacity 0.5s ease-in-out';
        chips.style.opacity = 1;  
    }, 10);
}

function sessao() {
    chips.style.opacity = 0; 
    setTimeout(() => {
        chips.style.display = 'none'; 
    }, 500);  
}
