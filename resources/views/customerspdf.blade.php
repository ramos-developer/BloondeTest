<html>
<head>
  <style>
    body{
      font-family: sans-serif;
      color:#454545;
    }
    .hobbies {
        margin: 15px;;
    }
    @page {
      margin: 160px 50px;
    }
    header { position: fixed;
      left: 0px;
      right: 0px;
      height: 50px;
      top: -100px;
      text-align: center;
    }
    header h1{
      margin: 10px 0;
      color: #F34423
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: -50px;
      right: 0px;
      height: 40px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
    }
    footer .izq {
      text-align: left;
    }
  </style>
<body>
  <header>
      <h1>
        <img src="{{ asset('/img/laravel.png') }}" style="width:54px">
        Exportación de Clientes
    </h1>
  </header>
  <footer>
    <table>
      <tr>
        <td>
            <p class="izq">
                Desarrollado por: Francisco Ramos
            </p>
        </td>
        <td>
          <p class="page">
            Página
          </p>
        </td>
      </tr>
    </table>
  </footer>
  <div id="content">
    <ol>
        @foreach ($customers as $customer)
            <li>
                <strong>
                    Nombre y Apellidos:
                </strong>
                {{$customer->name}} {{$customer->surname}}
                <br/>
                <strong>Hobbies:</strong>
                <ul class="hobbies">
                    @foreach ($customer->hobbies as $hobbie)
                        <li>
                            {{$hobbie->name}}
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ol>
  </div>
</body>
</html>
