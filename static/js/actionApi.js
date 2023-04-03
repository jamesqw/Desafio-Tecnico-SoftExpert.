//Design Pattern - Module Pattern
var apiModule = (function() {
    // Função privada que faz a chamada AJAX para a API
    function _makeAPICall(endpoint, params, successCallback) {
     return $.ajax({
        url: './api.php?endpoint=' + endpoint,
        method: 'GET',
         data: params,
        dataType: 'json',
        success: successCallback
      });
    }
  
    // Função pública que chama a API
    function callAPI(endpoint, data, successCallback) {
      return _makeAPICall(endpoint, data, successCallback);
    }
  
    return {
      callAPI: callAPI
    };
  
})();

function addProduct(){
    var nameProduct = document.getElementById("nameProduct").value;
    var typeProduct = document.getElementById("typeProduct").value;
    var price = document.getElementById("price").value;
    validadeinput = validadeinputValue(price);

    if (nameProduct === "" || typeProduct === "" || price === "") {
        alert("Preencha todos os campos.");
        return;
    }

    if (validadeinput) {
        alert("Valor não permitido. Informe apenas número.");
        return;
    } 

    var data = {
        nameProduct: nameProduct,
        typeProduct: typeProduct,
        price: formatPriceValueSave(price)
    };

    apiModule.callAPI("addProduct", data,function(response) {
        if (response ==="OK"){
            alert("Inclusão realizada com sucesso!");
            $('#modalIncluir').modal('hide');
            document.getElementById("list-product").click();
         } else{
            alert("Não foi possível incluir");
         }
    });
}

function saveSale(){
    apiModule.callAPI("saveSale", {}, function(response) {
        if (response ==="OK"){
            alert("Venda salva com sucesso!");
            $('#modalIncluir').modal('hide');
             clearProductsSale();
             document.getElementById("list-sale").click();
         } else{
            alert("Não foi possível incluir");
         }
    });
}

function addTypeProduct() {
    var percent = document.getElementById("percent-input").value;
    var nameType = document.getElementById("nameType").value;

    if (percent === "" || nameType === "") {
        alert("Preencha todos os campos.");
        return;
    }

    apiModule.callAPI("insertTypeProduct", {nameType,percent}, function(response) {
        if (response ==="OK"){
            alert("Inclusão realizada com sucesso!");
            $('#modalIncluir').modal('hide');
            document.getElementById("type-product").click();
         } else{
            alert("Não foi possível incluir");
         }
    });
}

function getProductById(){
    var cdProduct= document.getElementById("inputCdProduct").value;
    var amountProduct = document.getElementById("inputAmountProduct").value;
    amountProduct = amountProduct == '' ? 1 : amountProduct;

    apiModule.callAPI("getProductbyId", {cdProduct, amountProduct},function(response) {
        console.log(response.findProduct);
        if(response.findProduct == true){
            listProductSale();
            document.getElementById('inputCdProduct').value = '';
        }else{
            alert("Produto não encontrado.");
            return;
        }
        },function(error) {
        console.error("Erro ao chamar a API:", error);
    });
}

function listProductSale() {
    apiModule.callAPI("listProductSale", {},function(response) {
       sale = 1;
        Utils.tpl(document.querySelector('.side-content'), 'sales', {       
            productsSale: generateDOMList(response.products, 3),
            totalValue: "Total da compra: " +  formatValueMoney(response.total),
            totalTax: "Total de Impostos: " + formatValueMoney(response.taxTotal)
        });         
    });       
}   

function clearProductsSale(){
    sale = 0;
    apiModule.callAPI("clearProductsSale", {},function() {
        return;            
    }); 
}

function deleteItem(){
   var clicktable = getTableClick(tableItem);

    if(idItem !== ""){
        apiModule.callAPI(tableItem, {idItem},function(response) {
            console.log(response.return);
            if(response.return.includes("Foreign key violation")){
                alert("Não foi possível excluir, já possuí um produto/item atrelado.");
                return;
            }else{
                alert("Exclusão realizada com sucesso.");
                document.getElementById(clicktable).click();
            }
            idItem = 0;
        });  
    }else{
        alert("Selecione um item para excluir.");
    }
}