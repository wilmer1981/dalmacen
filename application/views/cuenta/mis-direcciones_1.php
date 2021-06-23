<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<section id="form"><!--form-->
	<div class="container">
  <div class="row">
    <div class="col-sm-3 hidden-xs column-left" id="column-left">
      <div class="Categories left-sidebar-widget">
        <h2 class="section-title">MENU DE USUARIO</h2>
		<!--
		 <div class="columnblock-title">MENU DE USUARIO</div>
		 -->		
        <div class="category_block">
          <ul class="box-category">
            <li><a href="<?php echo base_url("cuenta/mi-cuenta"); ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Mi Cuenta</a></li>
            <li><a href="<?php echo base_url("cuenta/mis-direcciones"); ?>"><i class="fa fa-map-marker fa-fw" aria-hidden="true"></i> Mis Direcciones</a></li>           
			<li class="separator"></li>
			<li><a href="<?php echo base_url("cuenta/mis-pedidos"); ?>"><i class="fa fa-truck fa-fw" aria-hidden="true"></i> Mis Pedidos</a></li>
            <!--<li><a href="#">Downloads</a></li>
            <li><a href="#">Reward Points</a></li>
            <li><a href="#">Transactions</a></li>
            <li><a href="#">Returns</a></li>
			-->
			<li class="separator"></li>
            <li><a href="#"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Newsletter</a></li>
            <li><a href="#"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Recurring payments</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="col-sm-9" id="content">
	<div class="Categories right-sidebar-widget">
	<h2 class="section-title">Mis Direcciones</h2>
	<div class="profile-form">
	<form method="post" id="formProfile" class="form-horizontal">
      <div class="row">
      	<div class="col-sm-12">
		<section class="section-first list-address">
		<a href="javascript:void(0);" class="address-info">
		<div class="address-list-users">
		<table>
		<tbody>
		<tr><td><span>Direción: </span></td><td><strong>Jr Los Olmos 456</strong></td></tr>
		<tr><td><span>Referencia: </span></td><td><strong>POR LA PLZA CENTRAL DE SJL</strong></td></tr>
		<tr><td><span>Ubigeo: </span></td><td><strong>LIMA, LIMA, SAN JUAN DE LURIGANCHO</strong></td></tr>
		</tbody></table>
		</div></a><div class="options"><span data-id="0" data-action="add"><i class="material-icons green-plt success-text">check_circle_outline</i> Dirección predeterminada</span><span data-id="0" data-action="del"><img class="float-right icon-del" src="https://d13xymm0hzzbsd.cloudfront.net/1/20190410/15549287829624.svg"></span><span data-id="0" data-action="edit" class=""><img class="float-right icon-edit" src="https://d13xymm0hzzbsd.cloudfront.net/1/20190410/15549287830619.svg"></span></div><div class="text-center"><button class="btn-green-new new-address invert-green-btn" id="new_id_users_addresses" value="">Agregar nueva dirección</button> <button class="btn-green-new new-address" id="new_id_stores">Agregar nueva tienda de envío</button> </div>
		</section>
    <!----><div class="option-card option-card-deck col-xs-12 col-sm-6 col-md-4" ng-repeat="address in addressBook.addresses" style="">
      <input type="radio" id="shipping-942620" name="selected-shipping" ng-value="address.id" ng-model="addressBook.selected[addressBook.type]" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="942620">
      <label for="shipping-942620" ng-click="addressBook.allowedSetDefault ? addressBook.setDefault(address.id) : addressBook.select(address.id)" ng-class="{'hide-radio': addressBook.editable || addressBook.removable}" class="hide-radio">
        <div class="clearfix">
          wilmer saldaña
        </div>
        <address class="address" ng-bind="address.fullFormat">Departamento
Prolongacion Cuzco
1297
LIMA, SAN MIGUEL, LIMA
Teléfono: 953613593</address>
        <div ng-show="addressBook.editable || addressBook.removable">
          <input type="radio" id="shipping-942620-ri" name="selected-shipping-ri" ng-value="address.id" ng-model="addressBook.selected[addressBook.type]" class="ng-pristine ng-untouched ng-valid ng-not-empty" value="942620">
          <label class="radio-item" for="shipping-942620-ri" ng-click="addressBook.allowedSetDefault ? '' : addressBook.select(address.id)">
            <div class="shipping-quote-title clearfix">
              Dirección predeterminada
            </div>
          </label>
        </div>
        <div class="option-card-footer" ng-click="$event.stopPropagation()" ng-show="addressBook.editable || addressBook.removable">
          <a class="link-low-sm" href="#" ng-click="addressBook.edit(address.id)" ng-show="addressBook.editable">Editar</a>
          <a class="link-low-sm" href="#" ng-click="addressBook.remove(address.id)" ng-show="addressBook.removable">Eliminar</a>
        </div>
      </label>
    </div><!---->
  </div>
	
      </div>
	  </form>
	  </div>
    </div>
	</div>
  </div>
</div>
</section>
<div id="address-form" class="modal" tabindex="-1">
  <div class="modal-dialog row">
    <div class="modal-content col-xs-12">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">Agregar nueva dirección</h4>
      </div>
      <div class="modal-body">
        <address-form type="shipping"><form name="address" method="post" class="ng-pristine ng-valid-pattern ng-invalid ng-invalid-required ng-valid-maxlength">
        <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_firstName">Nombre</label><input type="text" id="address_firstName" name="address[firstName]" required="required" ng-model="addressForm.input.firstName" pattern="^[a-zA-Z0-9À-ÿ]{1}[a-zA-Z0-9À-ÿ-'.,&amp;() ]+$" ng-focus="" autocomplete="given-name" apply-defaults="" class="form-control  ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required ng-valid-pattern" value="wilmer"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_lastName">Apellidos</label><input type="text" id="address_lastName" name="address[lastName]" required="required" ng-model="addressForm.input.lastName" pattern="^[a-zA-Z0-9À-ÿ]{1}[a-zA-Z0-9À-ÿ-'.,&amp;() ]+$" ng-focus="" autocomplete="family-name" apply-defaults="" class="form-control  ng-pristine ng-untouched ng-valid ng-not-empty ng-valid-required ng-valid-pattern" value="saldaña"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_mobilePhone">Teléfono Celular</label><input type="text" id="address_mobilePhone" name="address[mobilePhone]" required="required" ng-model="addressForm.input.mobilePhone" ng-focus="" mask="999999999" autocomplete="tel" apply-defaults="" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label" for="address_phone">Otro Teléfono (opcional)</label><input type="text" id="address_phone" name="address[phone]" ng-model="addressForm.input.phone" ng-focus="" mask="999999999" autocomplete="tel home" apply-defaults="" class="form-control  ng-pristine ng-untouched ng-valid ng-empty"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_type">Tipo de Dirección</label><select id="address_type" name="address[type]" required="required" ng-model="addressForm.input.type" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><option value="" selected="selected">Seleccione un Tipo de Dirección</option><option value="Casa">Casa</option><option value="Departamento">Departamento</option><option value="Condominio">Condominio</option><option value="Residencial">Residencial</option><option value="Oficina">Oficina</option><option value="Local">Local</option><option value="Centro">Centro</option><option value="Mercado">Mercado</option><option value="Galería">Galería</option><option value="Otro">Otro</option></select></div>
          <!----><div class="col-xs-12 col-md-12 toggle-checkbox-row" ng-if="!addressForm.hideNotifications"><span class="icon icon-sm"></span><label class="form-label" for="address_notificationsOptInwhatsapp">Quiero recibir alertas sobre el estado de mi pedido por Whatsapp</label><label for="address_notificationsOptInwhatsapp" class="toggle-checkbox"><input type="checkbox" id="address_notificationsOptInwhatsapp" name="address[notificationsOptInwhatsapp]" containerclass="col-xs-12 col-md-12" toggle-checkbox="toggle-checkbox" class="form-control ng-pristine ng-untouched ng-valid ng-not-empty" ng-model="addressForm.input.notificationsOptInwhatsapp" icon="&amp;#xE063" containerattr="ng-if=&quot;!addressForm.hideNotifications&quot;" value="1"><div class="toggle-slider"></div></label></div><!---->
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_line1">Dirección</label><input type="text" id="address_line1" name="address[line1]" required="required" ng-model="addressForm.input.line1" ng-focus="" autocomplete="address-line1" maxlength="250" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required ng-valid-maxlength"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_lot">Nro/Lote</label><input type="text" id="address_lot" name="address[lot]" required="required" ng-model="addressForm.input.lot" ng-focus="" autocomplete="address-level3" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label" for="address_department">Depto./Int (opcional)</label><input type="text" id="address_department" name="address[department]" ng-model="addressForm.input.department" ng-focus="" autocomplete="address-level3" class="form-control  ng-pristine ng-untouched ng-valid ng-empty"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label" for="address_urbanization">Urbanización (opcional)</label><input type="text" id="address_urbanization" name="address[urbanization]" ng-model="addressForm.input.urbanization" ng-focus="" autocomplete="address-line3" class="form-control  ng-pristine ng-untouched ng-valid ng-empty"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label" for="address_line2">Referencia (opcional)</label><input type="text" id="address_line2" name="address[line2]" ng-model="addressForm.input.line2" class="form-control  ng-pristine ng-untouched ng-valid ng-empty"></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_region">Departamento</label><select id="address_region" name="address[region]" required="required" ng-model="addressForm.input.region" ng-change="addressForm.loadMunicipalities(['municipality', 'city'])" ng-focus="" autocomplete="address-level1" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><option value="" selected="selected">Seleccione un Departamento</option><option value="AMAZONAS">AMAZONAS</option><option value="ANCASH">ANCASH</option><option value="APURIMAC">APURIMAC</option><option value="AREQUIPA">AREQUIPA</option><option value="AYACUCHO">AYACUCHO</option><option value="CAJAMARCA">CAJAMARCA</option><option value="CALLAO">CALLAO</option><option value="CUSCO">CUSCO</option><option value="HUANCAVELICA">HUANCAVELICA</option><option value="HUANUCO">HUANUCO</option><option value="ICA">ICA</option><option value="JUNIN">JUNIN</option><option value="LA LIBERTAD">LA LIBERTAD</option><option value="LAMBAYEQUE">LAMBAYEQUE</option><option value="LIMA">LIMA</option><option value="LORETO">LORETO</option><option value="MADRE DE DIOS">MADRE DE DIOS</option><option value="MOQUEGUA">MOQUEGUA</option><option value="PASCO">PASCO</option><option value="PIURA">PIURA</option><option value="PUNO">PUNO</option><option value="SAN MARTIN">SAN MARTIN</option><option value="TACNA">TACNA</option><option value="TUMBES">TUMBES</option><option value="UCAYALI">UCAYALI</option></select></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_municipality">Provincia</label><select id="address_municipality" name="address[municipality]" required="required" ng-model="addressForm.input.municipality" ng-change="addressForm.loadCities()" ng-options="municipality.id as municipality.name for municipality in addressForm.municipalities" ng-focus="" autocomplete="address-level2" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><option value="" selected="selected">Seleccione una Provincia</option></select></div>
          <div class="col-xs-12 col-md-6 "><label class="form-label required" for="address_city">Distrito</label><select id="address_city" name="address[city]" required="required" ng-model="addressForm.input.city" ng-options="city.id as city.name for city in addressForm.cities" ng-focus="" autocomplete="address-level3" class="form-control  ng-pristine ng-untouched ng-empty ng-invalid ng-invalid-required"><option value="" selected="selected">Seleccione una Distrito</option></select></div>
          <!----><div class="col-xs-12 col-md-12 toggle-checkbox-row" ng-if="!addressForm.hideDefaultAddress"><span class="icon icon-sm"></span><label class="form-label" for="address_defaultShipping">Usar como dirección predeterminada</label><label for="address_defaultShipping" class="toggle-checkbox"><input type="checkbox" id="address_defaultShipping" name="address[defaultShipping]" containerclass="col-xs-12 col-md-12" icon="&amp;#xE055" toggle-checkbox="toggle-checkbox" ng-model="addressForm.input.defaultShipping" containerattr="ng-if=&quot;!addressForm.hideDefaultAddress&quot;" class="form-control ng-pristine ng-untouched ng-valid ng-empty" value="1"><div class="toggle-slider"></div></label></div><!---->
  
</form>

<!----><div class="row" ng-if="!addressForm.hideSaveButton">
  <button class="btn btn-sm col-xs-12 col-md-offset-6 col-md-6 btn-disabled" ng-class="address.$valid ? 'btn-primary' : 'btn-disabled'" ng-disabled="!address.$valid" ng-click="addressForm.save()" disabled="disabled">
    Guardar dirección
  </button>
</div><!---->
</address-form>
      </div>
    </div>
  </div>
</div>
		