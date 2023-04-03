(function(w, d) {
	cobsystemInfo = w.cobsystemInfo;
    var typeprodut ="";

    function listProdut(){
        document.getElementById("list-product").click();
        getProducts();    
      
        apiModule.callAPI("listProducts", {}).then(function(response) {
            Utils.tpl(d.querySelector('.side-content'), 'list-products', {  
                addProduct: 1,
                listProduct: 1,
                addTypeProduct: 0,
                impostProduct: 0,
                comboTypeProduct:generateDOMCombo(typeprodut),
                products: generateDOMList(response, 1)
            });
            },function(error) {
            console.error("Erro ao chamar a API:", error);
        });
    }

    function getProducts(){
        apiModule.callAPI("selectTypeProduct", {}).then(function(response) { 
            typeprodut = response;
            return ;
        })
        .catch(function(error) {
            console.error("Erro ao chamar a API:", error);
        });
        return;
    }

    function listTypeProdut() {
        apiModule.callAPI("selectTypeProduct", {},function(response) {    
            Utils.tpl(d.querySelector('.side-content'), 'list-products', {  
                addProduct: 0,
                addTypeProduct: 0,
                impostProduct: 0,
                listTypeProduct: 1,
                typeProducts: generateDOMList(response, 2)
            });
        });
    }   

    function listSale() {
        Utils.tpl(document.querySelector('.side-content'), 'sales', {       
            productsSale: "",
            totalValue: "Total da compra:",
            totalTax: "Total de Impostos: "
        });         
    } 
     
    function generateDOMCombo(lists){
        console.log(lists);
        return lists.map(function(list) {
            return {
                cdProduct: list.cdtypeproduct,
                nmProduct: list.nmtypeproduct
            }
        });
    }
    
    listenEvents();

    function listenEvents() {
		setTimeout(function() {
			var clickProdut = $('.btn.btn-secondary.product');
            var clickTypeProdut  = $('.btn.btn-secondary.typeProduct');
            var clickSales  = $('.btn.btn-secondary.sale');

			clickProdut.off('click', listProdut);
			clickProdut.on('click', listProdut);

            clickTypeProdut.off('click', listTypeProdut);
			clickTypeProdut.on('click', listTypeProdut);

            clickSales.off('click', listSale);
            clickSales.on('click', listSale);
		}, 100);
	}
})(window, document);

var sale = 0;
var tableItem = "";
var idItem = "";

function generateDOMList(lists, screen){
    return lists.map(function(list) {

      if(screen==1){
        return {
            cdProduct:list.cdproduct,
            nmProduct: list.nmproduct,
            price: 'R$ ' + (list.price).replace('.',','),
            nmTypeProduct: list.nmtypeproduct
        }
      }else if(screen==2){
        return {
            cdTypeProduct: list.cdtypeproduct,
            nmTypeProduct: list.nmtypeproduct,
            taxType: list.tax + "%"
        }
      }else{
        return {
            cdProduct: list.cdproduct,
            nmProduct: list.nmproduct,
            price: formatValueMoney(list.price),
            amount: list.amount,
            taxValue: formatValueMoney(list.taxValue)
        }
      }
    });
}

function handleClickCheckbox(checkbox, table) {
    if (checkbox.checked) {
        linha = checkbox.parentNode.parentNode;
        idItem = linha.cells[1].textContent;
        tableItem = table;
    }
}

function getTableClick(table) {
    console.log(table);
    if (table.includes("Type")) {
        clicktable = "type-product";
    }else{
        clicktable = "list-product";
    }
    return clicktable;
}

$(document).click(function(event) {
    var element = $(event.target);

    if (element[0].className.includes('btn btn-secondary') && sale==1){
        if (confirm("Deseja realmente sair? A venda será cancelada.")) {
            clearProductsSale();
            sale = 0;
            return;
        }else{
            listProductSale();
            //listSale();
            //
        }
    }
});

window.onload = function(){
    clearProductsSale();
}