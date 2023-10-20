<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <i class="icon-AdminOrders"></i> {l s='Estimation Details' d='Modules.JmEstimation.Feature'}
                </div>
                <div class="panel-body">
                    {if isset($estimation)}
                        <table class="table table-borderless table-striped">
                            <tbody>
                                <tr>
                                    <th>{l s='ID' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->id_estimation}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Duct Type' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->duct_type}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Stove Height' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->stove_height}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Stove Ceiling Height' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->stove_ceiling_height}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Parapet Height' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->parapet_height}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Installation Timeframe' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->installation_timeframe}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Heating Appliance' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->heating_appliance}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Smoke Outlet Diameter' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->smoke_outlet_diameter}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Additional Details' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->additional_details}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Last Name' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->last_name}</td>
                                </tr>
                                <tr>
                                    <th>{l s='First Name' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->first_name}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Address' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->address}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Email' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->email}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Phone' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->phone}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Sending' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{if $estimation->sending }SENT{else}NOT SENT{/if}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Created At' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->created_at}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Updated At' d='Modules.JmEstimation.Feature'}</th>
                                    <td>{$estimation->updated_at}</td>
                                </tr>
                                <tr>
                                    <th>{l s='Drawing File' d='Modules.JmEstimation.Feature'}</th>
                                    <td>
                                        <img class="img-thumbnail" src="{$imageLink}" alt="{$estimation->drawing_file}">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    {else}
                        <p>{l s='Estimation not found' d='Modules.JmEstimation.Feature'}</p>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>