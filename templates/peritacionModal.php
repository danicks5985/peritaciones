<!-- Modal ver peritación -->
<div class="large reveal" id="verPeritacionModal" data-reveal>
    <form id="savePeritacionForm" action="Php/editPeritacion.php" method="post">
        <input type="hidden" name="id" id="id" value="">
        <div class="grid-container fluid">
            <div class="grid-x  grid-padding-x">
                <div class="cell small-2 text-right">
                    <label style="font-weight: bold;">MANO OBRA: </label>
                </div>
                <div class="cell small-4">
                    <label class="manoObra_cell"></label>
                </div>
                <div class="cell small-2 text-center concesionario_cell">
                    <label style="background: #b7d8b7;">CONCESIONARIO</label>
                </div>
                <div class="cell small-2 text-center multimarca_cell">
                    <label style="background: #d8b7b7;">MULTIMARCA</label>
                </div>
                <div class="cell small-2 text-center concertado_cell">
                    <label style="background: #f1a02752;">CONCERTADO</label>
                </div>
                
                <fieldset class="cell text-center callout" style="margin-top: 25px;">
                    <legend><strong><i class="far fa-edit"></i> Modificar peritación</strong></legend>

                    <div class="grid-x grid-padding-x">
                        <!-- Código taller -->
                        <div class="small-2 cell">
                            <label for="nameTaller" class="text-right middle">Código Taller</label>
                        </div>
                        <div class="small-10 cell text-left" style="padding-top: 8px;">
                            <strong><label id="codTaller_cell" style="font-weight: inherit;"></label></strong>
                        </div>
                    </div>


                    <div class="grid-x grid-padding-x">
                        <!-- taller -->
                        <div class="small-2 cell">
                            <label for="nameTaller" class="text-right middle">Taller</label>
                        </div>
                        <div class="small-3 cell">
                            <input id="nameTaller" type="text" autocomplete="off" required>
                            <input id="tallerId" name="tallerId" type="hidden">
                        </div>

                        <!-- matricula -->
                        <div class="small-1 cell">
                            <label for="matricula" class="text-right middle">Matrícula</label>
                        </div>
                        <div class="small-3 cell">
                            <input id="matricula" name="matricula" type="text" autocomplete="off" required>
                        </div>

                        <!-- Fecha peritación -->
                        <div class="small-1 cell">
                            <label for="f_peritacion" class="text-right middle">Fecha Peritación</label>
                        </div>
                        <div class="small-2 cell">
                            <input id="f_peritacion" name="f_peritacion" type="date" value="<?= date("Y-m-d"); ?>" required>
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <!-- Compañía -->
                        <div class="small-2 cell">
                            <label for="nameCompania" class="text-right middle">Compañía</label>
                        </div>
                        <div class="small-3 cell">
                            <input id="nameCompania" type="text" autocomplete="off" required>
                            <input id="companiaId" name="companiaId" type="hidden">
                        </div>

                        <!-- Perito -->
                        <div class="small-1 cell">
                            <label for="perito" class="text-right middle">Perito</label>
                        </div>
                        <div class="small-3 cell">
                            <select name="peritoId" id="perito" required>
                                <option value="">--</option>
                                <?

                                use Peritos\Peritos;

                                foreach ((new Peritos())->getPeritos() as $comp) {
                                    $id = $comp['id'];
                                    $name = $comp['nombre'];
                                    echo "<option value=$id>$name</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!-- Estado -->
                        <div class="small-1 cell">
                            <label for="estadoId" class="text-right middle">Estado</label>
                        </div>
                        <div class="small-2 cell">
                            <select name="estadoId" id="estadoId" required>
                                <option value="">--</option>
                                <?
                                    use Peritacion\Peritacion;
                                    foreach ((new Peritacion())->getAllStates() as $i => $ste) {
                                        echo "<option value=${ste['id']}>${ste['nombre']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="grid-x grid-padding-x">
                        <!-- Fecha cierre -->
                        <div class="small-2 cell">
                            <label for="f_cierre" class="text-right middle">Fecha Cierre</label>
                        </div>
                        <div class="small-3 cell">
                            <input id="f_cierre" name="f_cierre" type="date" value="">
                        </div>

                        <!-- kms -->
                        <div class="small-1 cell">
                            <label for="kms" class="text-right middle">Kms</label>
                        </div>
                        <div class="small-3 cell">
                            <input type="number" id="kms" name="kms">
                        </div>

                        <!-- Total peritación -->
                        <div class="small-1 cell">
                            <label for="total" class="text-right middle">Total</label>
                        </div>
                        <div class="small-2 cell">
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