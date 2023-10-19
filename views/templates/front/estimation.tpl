{extends file='page.tpl'}

{block name='page_title'}
    <span class="sitemap-title">{l s='Devis Personnalisé' d='Shop.Theme' d="Modules.JmEstimation.Shop"}</span>
{/block}

{block name='page_content'}
    <div id="estimation" class="container row">
        {* <h1>{l s='Devis Personnalisé' d="Modules.JmEstimation.Shop"}</h1> *}
        <p class="col-md-12">
            <strong>{l s='Quelle sera la configuration de votre future installation ?' d="Modules.JmEstimation.Shop"}<strong><br><small>{l s='Veuillez cliquer sur le visuel qui se rapprochera de votre futur conduit de cheminée.' d="Modules.JmEstimation.Shop"}</small>
        </p>
        <ul class="list-unstyled ductType-list col-md-12 d-flex flex-wrap">
            {foreach from=$ductTypes key=key item=ductType}
                <li class="col-md-4 p-1">
                    <a href="#" class="ductType-link" data-ducttype-id="{$key}" data-ducttype-image="{$ductType.image}"
                        data-ducttype-name="{$ductType.name}" data-toggle="modal" data-target="#ductType-modal">
                        <img src="{$ductType.image}" alt="{l s=$ductType.name d="Modules.JmEstimation.Shop"}"
                            class="img-fluid mb-1">
                        <small class="mt-1"
                            style="display:flex; justify-content: center;">{l s=$ductType.name d="Modules.JmEstimation.Shop"}</small>
                    </a>
                </li>
            {/foreach}
        </ul>
    </div>

    <div class="modal fade" id="ductType-modal" tabindex="-1" role="dialog" aria-labelledby="ductType-modal-label"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="ductType-modal-label"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form action="#" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="duct_type" id="ductType">

                        <div class="row form-group">
                            <div class="col-sm-12">
                                <div class="col-md-9 col-sm-12 text-center">
                                    <img id="ductType-image" src="" alt="" class="img-fluid">
                                </div>
                                <fieldset class="form-group col-md-3 col-sm-12">
                                    <legend class="form-text text-muted text-center">
                                        {l s='Prise de Mesures (mm)' d="Modules.JmEstimation.Shop"}
                                    </legend>
                                    <label
                                        for="stoveHeight"><strong>{l s='Hauteur du Poêle' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="number" name="stove_height" id="stoveHeight" class="form-control" required>

                                    <label
                                        for="stoveCeilingHeight"><strong>{l s='Hauteur Poêle / Plafond' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="number" name="stove_ceiling_height" id="stoveCeilingHeight"
                                        class="form-control" required>

                                    <label
                                        for="ceilingThickness"><strong>{l s='Épaisseur Plafond' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="number" name="ceiling_thickness" id="ceilingThickness" class="form-control"
                                        required>

                                    <label
                                        for="parapetHeight"><strong>{l s='Hauteur Acrotère' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="number" name="parapet_height" id="parapetHeight" class="form-control">
                                </fieldset>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group col-md-12">
                                    <label><strong>{l s='Délai Installation' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <small
                                        class="form-text text-muted">{l s='Vous souhaitez votre conduit sous quel délai ?' d="Modules.JmEstimation.Shop"}</small><br>
                                    <div class="form-check col-md-3 col-sm-6">
                                        <input class="form-check-input" type="radio" name="installation_timeframe"
                                            id="installationTimeframe1" value="15 jours" checked>
                                        <label class="form-check-label" for="installationTimeframe1">
                                            {l s='Prochain 15 jours.' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3 col-sm-6">
                                        <input class "form-check-input" type="radio" name="installation_timeframe"
                                            id="installationTimeframe2" value="1 mois">
                                        <label class="form-check-label" for="installationTimeframe2">
                                            {l s='D\'ici 1 mois.' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3 col-sm-6">
                                        <input class="form-check-input" type="radio" name="installation_timeframe"
                                            id="installationTimeframe3" value="2/3 mois">
                                        <label class="form-check-label" for="installationTimeframe3">
                                            {l s='D\'ici 2 à 3 mois.' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                    <div class="form-check col-md-3 col-sm-6">
                                        <input class="form-check-input" type="radio" name="installation_timeframe"
                                            id="installationTimeframe4" value="+3 mois">
                                        <label class="form-check-label" for="installationTimeframe4">
                                            {l s='Dans + de 3 mois.' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group col-md-9 col-sm-12">
                                    <label><strong>{l s='Appareil Chauffage' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <small
                                        class="form-text text-muted">{l s='Le conduit est prévu pour quel appareil de chauffage ?' d="Modules.JmEstimation.Shop"}</small><br>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="heating_appliance"
                                            id="heatingAppliance1" value="Poêle à granulés de bois" checked>
                                        <label class="form-check-label" for="heatingAppliance1">
                                            {l s='Poêle à granulés de bois' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="heating_appliance"
                                            id="heatingAppliance2" value="Poêle ou insert à bois">
                                        <label class="form-check-label" for="heatingAppliance2">
                                            {l s='Poêle ou insert à bois' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="heating_appliance"
                                            id="heatingAppliance3" value="Chaudière à granulés de bois">
                                        <label class="form-check-label" for="heatingAppliance3">
                                            {l s='Chaudière à granulés de bois' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="heating_appliance"
                                            id="heatingAppliance4" value="Chaudière à bois/bûches">
                                        <label class="form-check-label" for="heatingAppliance4">
                                            {l s='Chaudière à bois/bûches' d="Modules.JmEstimation.Shop"}
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group col-md-3 col-sm-12">
                                    <label
                                        for="smokeOutletDiameter"><strong>{l s='Diamètre Sortie Fumée Appareil Chauffage (mm)' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="number" name="smoke_outlet_diameter" id="smokeOutletDiameter"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label
                                        for="additionalDetails"><strong>{l s='Précisions Supplémentaires (max 500 caractères.)' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <small
                                        class="form-text text-muted">{l s='Merci de nous laisser des précisions supplémentaires si nécessaire...;)' d="Modules.JmEstimation.Shop"}</small>
                                    <textarea name="additional_details" id="additionalDetails" class="form-control" rows="3"
                                        maxlength="500"></textarea>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label
                                        for="drawingFile"><strong>{l s='Télécharger un Dessin (max 2Mb.)' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <small
                                        class="form-text text-muted">{l s='Si vous avez un dessin représentant votre installation ?' d="Modules.JmEstimation.Shop"}</small><br>
                                    <input type="file" name="drawing_file" id="drawingFile" class="form-control-file">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-sm-12">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="lastName"><strong>{l s='Nom' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="text" name="last_name" id="lastName" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label
                                        for="firstName"><strong>{l s='Prénom' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="text" name="first_name" id="firstName" class="form-control" required>
                                </div>
                                <div class="form-group col-md-12">
                                    <label
                                        for="address"><strong>{l s='Adresse' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="text" name="address" id="address" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="email"><strong>{l s='Email' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="email" name="email" id="email" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label
                                        for="phone"><strong>{l s='Téléphone' d="Modules.JmEstimation.Shop"}</strong></label>
                                    <input type="text" name="phone" id="phone" class="form-control" maxlength="10" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <button type="submit" name="estimation_submit"
                                    class="btn btn-primary btn-block">{l s='Envoyer ma Demande de Devis' d="Modules.JmEstimation.Shop"}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

{/block}