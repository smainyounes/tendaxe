@extends('layouts.profile')

@section('profile')
    <div class="container-fluid">
        <h5>Notifications</h5>
        <p>Paramétrez vos alertes mails afin de recevoir uniquement les publications qui vous intéressent !</p>

        <form action="">
            {{-- frequence --}}
            <div class="row">
                <div class="col-md-3">
                    <h6 class="mt-2">Frequence d'envoi</h6>
                </div>
                <div class="col-md-9 d-flex justify-content-between">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequence" id="inlineRadio1" value="aucun">
                        <label class="form-check-label" for="inlineRadio1">Aucun</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequence" id="inlineRadio2" value="everyday">
                        <label class="form-check-label" for="inlineRadio2">Journalier</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequence" id="inlineRadio3" value="weekly">
                        <label class="form-check-label" for="inlineRadio3">Hebdomadaire</label>
                      </div>                  
                </div>
            </div>

            <hr>

            {{-- secteurs --}}
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control selectpicker" multiple data-live-search="true" name="" id="">
                        {{-- get user secteur --}}
                    </select>
                </div>
                <div class="col-md-8">
                    <ul>
                        {{-- display notif secteurs --}}
                        <li>Secteur1</li>
                        <li>Secteur2</li>
                        <li>Secteur3</li>
                    </ul>
                </div>
            </div>

            <hr>

            {{-- wilaya --}}
            <div class="row">
                <div class="col-md-4">
                    <select class="form-control wil1 selectpicker" multiple data-live-search="true" name="" id=""></select>
                </div>
                <div class="col-md-8">
                    <ul>
                        <li>blida</li>
                        <li>alger</li>
                        <li>oran</li>
                    </ul>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-md-4">
                    <select name="statut" class="form-control mb-2 selectpicker" title="statut" data-live-search="true">
                        <option value="Mise en demeure et résiliation" data-tokens="Mise en demeure et résiliation">Mise en demeure et résiliation</option>
                        <option value="Adjudication" data-tokens="Adjudication">Adjudication</option>
                        <option value="Vente aux enchères" data-tokens="Vente aux enchères">Vente aux enchères</option>
                        <option value="Infructuosité" data-tokens="Infructuosité">Infructuosité</option>
                        <option value="Annulation" data-tokens="Annulation">Annulation</option>
                        <option value="Attribution de marché" data-tokens="Attribution de marché">Attribution de marché</option>
                        <option value="Prorogation de délai" data-tokens="Prorogation de délai">Prorogation de délai</option>
                        <option value="Appel d'offres & Consultation" data-tokens="Appel d'offres & Consultation">Appel d'offres & Consultation</option>
                    </select>
                </div>
            </div>

            <div class="text-right">
                <button class="btn btn-primary px-4">Appliquer</button>
            </div>

        </form>
    </div>

    <script>
        wilaya1();
    </script>
@endsection