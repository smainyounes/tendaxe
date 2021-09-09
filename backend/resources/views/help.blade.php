@extends('layouts.layout')

@section('title', 'Aide')
    
@section('content')
    <div class="container-fluid p-5" style="background: url({{ asset('img/banner/laptop_showing.jpg') }}) no-repeat center center; margin-top: 66px; background-size: cover;">
      <div class="container">
          <h3 class="text-white bold my-4">Aide</h3>
      </div>
    </div>
    <div class="container">
      <x-alert />
        <div class="accordion mt-5" id="accordionExample">
            <div class="my-3">
              <div class="border-0" id="headingOne">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="bold m-0">POUR QUOI JE CHOISIS TENDAXE</h5>
                    <button class="btn btn-link float-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <img src="{{ asset('img/icons/up_button.png') }}" alt="">
                    </button>
                </div>
              </div>
          
              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                  La plateforme Tenders-Dz offre à ses clients de nombreux avantages et fonctionnalités qui facilitent la navigation et vous rapproche encore plus des Marchés Publics. En utilisant la plateforme Tenders-dz vous serez toujours à publication quotidienne des appels d'offre parus dans les journaux dans les 48 Villes (wilayas) : Est Ouest et Nord algérien, mais aussi les consultations publiées dans les différentes APC en Algérie.
                  <br>
                  <br>
                  sans oublier les résultats d'appels Attribution, Annulation, d'offre Infructuosité, Mise en demeure. Et pour vous donner plus d'opportunité de marchés Tenders-dz assure une publication quotidienne des ventes aux enchères et des avis d'adjudication des 48 villes Algériennes.                  
                </div>
              </div>
            </div>
            <div class="my-3">
              <div class="border-0" id="heading2">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="bold m-0">NOS SOURCES DE DONNEES</h5>
                    <button class="btn btn-link float-right" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                        <img src="{{ asset('img/icons/up_button.png') }}" alt="">
                    </button>
                </div>
              </div>
          
              <div id="collapse2" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
                <div class="card-body">
                  <div>
                    <p class="mb-5">
                      ttChaque jour, TendAxe publie l’ensemble des annonces d’achat et vente (Appel d’offres, Consultations, Prorogations de délais, Attributions, Annulations, Informations, Ventes aux enchères, Adjudications) de plusieurs sources :
                    </p>

                    <ul class="mb-5">
                      <li>la presse écrite algérienne (jusqu’à 100 journaux),</li>
                      <li>des dizaines de sites d’acheteurs publics,</li>
                      <li>	les revues spécialisés comme le Bulletin Officiel des Marchés de l'Opérateur Public – BOMOP et Bulletin des Appels d'Offres du Secteur de l'Energie et des Mines – BAOSEM.</li>
                    </ul>

                    <p class="mt-5 mb-3">
                      Les acheteurs actifs sur TendAxe.com publient également des consultations exclusives directement sur le site.
                    </p>

                    <div class="row justify-content-center">
                      <div class="col d-flex justify-content-center flex-column align-items-center">
                        <img class="img-fluid my-auto" src="{{ asset('img/logos/boasem.png') }}" alt="">
                        <span class="bold">BAOSEM</span>
                      </div>
                      <div class="col d-flex justify-content-center flex-column align-items-center">
                        <img class="img-fluid my-auto" src="{{ asset('img/logos/bomop.png') }}" alt="">
                        <span class="bold">BOMOP</span>
                      </div>
                      <div class="col d-flex justify-content-center flex-column align-items-center">
                        <img class="img-fluid my-auto" src="{{ asset('img/logos/websites.png') }}" alt="">
                        <span class="bold">Sites Web</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="my-3">
              <div class="border-0" id="heading3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="bold m-0">Comment s'abonner sur TendAxe ?</h5>
                    <button class="btn btn-link float-right" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                        <img src="{{ asset('img/icons/up_button.png') }}" alt="">
                    </button>
                </div>
              </div>
          
              <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordionExample">
                <div class="card-body">
                  <div class="mb-3">
                    <div class="bold">INSCRIPTION</div>  
                    Inscrivez gratuitement en tant que nouveau utilisateur et bénéficier de 3 jour d’essai gratuit (Nom, Prénom, Nom de l'entreprise, numéro de téléphone, e-mail, mot de passe et certains champs
                  </div>
                  <div class="mb-3">
                    <div class="bold">
                      LE CHOIX DE LA FORMULE
                    </div>
                    IL existe 5 formules et chaque une a sa spécification par rapport le nombre de secteur, d’activité, le nombre d’utilisateur, voir les  ventes  à l’enchère …… clique ici pour voir les différentes  formules 
                  </div>
                  <div class="mb-3">
                    <div class="bold">
                      Payment  
                    </div>
                    <ul>
                      <li>
                        Payez les frais de l’abonnement choisis Par un dépôt ou virement sur le compte postal:
                        <br>
                        LABOUDI Abdelwahab - CCP: 0020888454/45
                      </li>
                      <li>
                        Veuillez envoyer une copie de la preuve de paiement par Viber à l'un des numéros suivants: 0665379954
                        <br>
                        Ou Via l'e-mail suivant: contact.TendAxe@gmail.com
                      </li>
                      <li>
                        Payez en espèces ou par chèque en vous rendant dans nos bureaux situés à l'adresse suivante:
                        <br>
                        Rue les frères mostapha Bouinan-Blida.
                      </li>
                      <li>
                        votre compte sera activé dés la réception de votre reçu payment.
                      </li>
                    </ul>
                  </div>

                  <div class="mb-3">
                    <div class="bold">
                      Activation 
                    </div>
                    activation de votre compt avec donner la possibilité avec donner la possibilité de modifier 
                    votre système de notification
                  </div>

                </div>
              </div>
            </div>
        </div>

      
      <div class="my-5 d-flex">
        <a href="#" class="btn btn-primary flex-fill">Offre de service</a>
        <a href="#" class="btn btn-primary mx-2 flex-fill">Tarification CDC</a>
        <a href="{{ route('docs') }}" class="btn btn-primary flex-fill">Document utiles</a>
      </div>

      <section id="acheteurs" class="my-5">
        <h1 class="bold text-center text-gray">Notre acheteurs active</h1>
        <div class="text-center my-5">
          <img class="img-fluid" src="{{ asset('img/acheteurs/1.png') }}" alt="">
        </div>
        <div class="row justify-content-center my-4">
        @for ($i = 2; $i <= 8; $i++)
          <div class="col text-center">
            <img class="img-fluid" src="{{ asset('img/acheteurs/'.$i.'.png') }}" alt="">
          </div>
        @endfor
        </div>
        <div class="row justify-content-center my-4">
          @for ($i = 9; $i <= 15; $i++)
            <div class="col text-center">
              <img class="img-fluid" src="{{ asset('img/acheteurs/'.$i.'.png') }}" alt="">
            </div>
          @endfor
        </div>
      </section>
    </div>
@endsection