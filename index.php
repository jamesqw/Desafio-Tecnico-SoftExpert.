<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SoftMarket</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
    <link rel="stylesheet" href="static/fontello/css/fontello.css"/>
  </head>
  <body>
  <div class="cabecalho">
  <nav class="navbar">
      <a class="navbar-brand" href="#">SoftMarket</a>
      <div class="button">
        <button class="btn btn-secondary typeProduct" id="type-product" type="button">
            Tipo Produto
          </button>
          <button class="btn btn-secondary product" id="list-product" type="button">
            Produto
          </button>
          <button class="btn btn-secondary sale" id="list-sale" type="button" >
            Venda
          </button>
      </div>
</nav>
</div>

<div class="side-content">
    <div class="initial-content">
      <i class="icon-basket"></i>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="static/lib/jquery.multi-select.min.js"></script>
<script src="static/js/utils.js"></script>
<script src="static/js/validationForms.js"></script>
<script src="static/js/actionApi.js"></script>
<script src="static/js/listenHtml.js"></script>
<script type="text/javascript" src="static/js/lib/mustache.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>