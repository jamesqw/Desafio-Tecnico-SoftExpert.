function onlynumber(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode(key);
    var regex = /^[0-9.]+$/;
    if( !regex.test(key) ) {
       theEvent.returnValue = false;
       if(theEvent.preventDefault) theEvent.preventDefault();
    }
 }

function validadeinputValue(value){
    const regex = /[^\d\s,.]/;  
    const hasletter = regex.test(value);
    return hasletter;
}

function formatValuePricePress() {
    var elemento = document.getElementById('price');
    var valor = elemento.value;
    
    valor = valor + '';
    valor = parseInt(valor.replace(/[\D]+/g,''));
    valor = valor + '';
    valor = valor.replace(/([0-9]{2})$/g, ",$1");
  
    if (valor.length > 6) {
      valor = valor.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");
    }
    if(valor === 'NaN') valor = "";
    elemento.value = valor;
  }

function formatValueMoney(value){
    var value = value.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
    console.log(value);
    return  value;
}

function convertValuePorcent(tax){
    return tax + "%";
}

function formatPriceValueSave(price){
    price = price.replace(",",'.');
    return price.replace(/\.(?=.*\.)/g, "");
}

function enterPress(event){
    const keyCode = event.keyCode;
    const tecla = String.fromCharCode(keyCode);
    const regex = /[0-9]/;

    if (!regex.test(tecla)) {
      event.preventDefault();
    }

   var x = event.which || event.keyCode;
   if(x == 13){
        getProductById();
    }
}

function convertValuePorcent(tax){
    const porcentagem = (tax * 100).toFixed(2);
    return porcentagem + "%";
}