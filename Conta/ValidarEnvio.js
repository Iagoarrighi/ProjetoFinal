document.getElementById("enviar").onclick = e =>{
  const email = document.getElementById("email");
  const nome = document.getElementById("nome");
  if (!email.value || !nome.value){
    alert("Preencha todos os campos...");
  }
  else{
    document.getElementById("feed-form").submit();
    alert("Sucesso!");
  }
}