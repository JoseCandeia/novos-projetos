function cadastro(event) {
    event.preventDefault()
    const nome = document.getElementById("nome").value; 
    const confirma = document.getElementById("check-box-retorno")
    const body = document.getElementsByTagName("body")[0]
    const form = document.getElementsByTagName("form")[0]

    if (nome === "edu") {
        
        confirma.style.display='flex'
        
        setTimeout(() => {
            confirma.style.opacity = 1;
            confirma.style.transform = 'translate(-50%, -50%) scale(1)'; 
        }, 10);  
        
    } else {
        alert("Erro");
    }
}

function confirm(){
    return window.location.href="login.php"  

}