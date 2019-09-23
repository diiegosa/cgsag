<div id="breadcrumbs-wrapper">
    <div class="container container-fluid">
        <div class="row">
            <div class="col s10 m6 l6">
                <h5 class="breadcrumbs-title"><strong>Cadastro de Pessoas</strong></h5>
                <ol class="breadcrumbs">
                    <li><a href="/people">Página inicial</a></li>
                    @isset($local)
                        <li class="active">{{$local}}</li>
                    @endisset
                </ol>
            </div>
        </div>
    </div>
</div>