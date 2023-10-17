<form name="form_Materiales">
    <label for="Materiales">Nombre del material:</label>
    <input type="text" id="Materiales" name="Materiales" required>
    <br>
    <label for="modelo">ID del modelo:</label>
    <input type="number" id="modelo" name="modelo" required>
    <br>
    <input type="button" value="Grabar" onclick="grabarMateriales()">
</form>
<div class="message hiddenD">
    Material dado de alta correctamente.
</div>