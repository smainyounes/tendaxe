@extends('layouts.layout')

@section('title', 'Aide')
    
@section('content')
    <div class="container main">
      <x-alert />
        <h2 class="bold">Aide</h2>
        <div class="accordion mt-4" id="accordionExample">
            <div class="my-3">
              <div class="border-0" id="headingOne">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="bold m-0">Comment s’abonner?</h5>
                    <button class="btn btn-link float-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <img src="{{ asset('img/icons/up_button.png') }}" alt="">
                    </button>
                </div>
              </div>
          
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lobortis in nibh massa eget. Lorem velit, commodo vitae nulla sed volutpat rhoncus sed.
                </div>
              </div>
            </div>
            
        </div>
        <div class="accordion mt-4" id="accordionExample">
            <div class="my-3">
              <div class="border-0" id="headingOne">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="bold m-0">Quelles sont les sources légales de Tendfox ?</h5>
                    <button class="btn btn-link float-right" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        <img src="{{ asset('img/icons/up_button.png') }}" alt="">
                    </button>
                </div>
              </div>
          
              <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            
        </div>
        <div class="accordion mt-4" id="accordionExample">
            <div class="my-3">
              <div class="border-0" id="heading3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="bold m-0">Quelles sont les sources légales de Tendfox ?</h5>
                    <button class="btn btn-link float-right" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        <img src="{{ asset('img/icons/up_button.png') }}" alt="">
                    </button>
                </div>
              </div>
          
              <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="card-body">
                  Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                </div>
              </div>
            </div>
            
        </div>
    </div>
@endsection