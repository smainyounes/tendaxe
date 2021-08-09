@extends('layouts.profile')

@section('profile')
    <div class="container-fluid">
        <h5 class="mb-4">Mes Abonnements</h5>
        <small>   
            <div>
                Abonnement Choisi: <b> pack gold </b>
                <div class="row justify-content-center">
                    <div class=" col-md-4 col-sm-6 p-2 ">
                        <div class="bg-white mx-auto pb-2 rounded-bottom h-100 border d-flex flex-column" style="max-width: 280px">
                            <div class="bg-yellow mb-3 rounded-top" style="height: 6px"></div>
                            <div class="text-center bold">Pack gold</div>
                            <div class="h1 text-center text-green my-4">
                                <span>26000</span> DZD/an
                            </div>
                            <div class="my-2 px-2">
                                <ul class="pl-3">
                                    <li>Choisissez six secteurs parmi tous les secteurs</li>
                                    <li>Toutes les options et fonctionnalités énumérées ci-dessus</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            secteurs selectionné:
            <ul class="my-2">
                <li>Secteur1</li>
                <li>Secteur1</li>
                <li>Secteur1</li>
                <li>Secteur1</li>
            </ul>

            <div class="d-flex justify-content-between">
                <div>
                    <div class="mb-2">
                        Debut de l'abonnement
                    </div>
                    <div class="mb-2">
                        12/12/12
                    </div>
                </div>
                <div class="text-right">
                    <div class="mb-2">
                        Fin de l'abonnement
                    </div>
                    <div class="mb-2">
                        12/12/12
                    </div>
                </div>
            </div>
            <div class="progress" style="border-radius: 20px">
                <div class="progress-bar bg-info" role="progressbar" style="width: 33%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </small>

        <div class="my-4">
            <h5>Historique de mes abonnements</h5>
            <small>
                <table class="table table-sm">
                    <tr>
                        <td>Type d'abonnement</td>
                        <td>Date debut</td>
                        <td>Date fin</td>
                    </tr>
                    <tbody class="bg-light">
                      <tr>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>

                    </tbody>
                </table>
            </small>

        </div>
    </div>
@endsection