<!-- Modal ver peritación -->
<div class="large reveal" id="verPeritacionModal" data-reveal>
    <form id="savePeritacionForm" action="Php/editPeritacion.php" method="post">
        <input type="hidden" name="id" id="id" value="">
        <div class="grid-container fluid">
            <div class="grid-x grid-margin-x grid-padding-x">
                <fieldset class="cell text-center callout" style="margin-top: 25px;">
                    <legend><strong><i class="far fa-edit"></i> Modificar peritación</strong></legend>

                    <div class="grid-x grid-padding-x">
                        <!-- Fecha cierre -->
                        <div class="small-2 cell">
                            <label for="f_cierre" class="text-right middle">Fecha Cierre</label>
                        </div>
                        <div class="small-3 cell">
                            <input id="f_cierre" name="f_cierre" type="date" value="">
                        </div>

                        <!-- Estado -->
                        <div class="small-1 cell">
                            <label for="estadoId" class="text-right middle">Estado</label>
                        </div>
                        <div class="small-3 cell">
                            <select name="estadoId" id="estadoId">
                                <option value="">--</option>
                                <?
                                    use Peritacion\Peritacion;

                                    foreach ((new Peritacion())->getAllStates() as $i => $ste) {
                                        echo "<option value=${ste['id']}>${ste['nombre']}</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <!-- kms -->
                        <div class="small-1 cell">
                            <label for="kms" class="text-right middle">Kms</label>
                        </div>
                        <div class="small-2 cell">
                            <input type="number" id="kms" name="kms">
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <!-- Total peritación -->
                        <div class="small-2 cell">
                            <label for="total" class="text-right middle">Total</label>
                        </div>
                        <div class="small-3 cell">
                            <input type="text" name="total" id="total">
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <!-- comentarios -->
                        <div class="small-2 cell">
                            <label for="comentarios" class="text-right middle">Comentarios</label>
                        </div>
                        <div class="small-10 cell">
                            <textarea name="comentarios" id="comentarios" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="cell">
                        <button type="submit" class="button" name="grabar_peritacion"><i class="far fa-edit"></i> Modificar peritación</button>
                    </div>
                </fieldset>
            </div>
        </div>
    </form>

    <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
    </button>
</div>