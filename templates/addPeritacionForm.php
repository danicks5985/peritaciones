<form id="addPeritacionForm" action="Php/peritacion_form.php" method="post" style="display: none;">

    <div class="grid-x grid-margin-x grid-padding-x">
        <fieldset class="cell text-center callout">
            <legend><strong><i class="far fa-edit"></i> Añadir peritación</strong></legend>

            <div class="grid-x grid-padding-x">
                <!-- taller -->
                <div class="small-1 cell">
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
                <div class="small-2 cell">
                    <input id="matricula" name="matricula" type="text" autocomplete="off" required>
                </div>

                <!-- Fecha peritación -->
                <div class="small-2 cell">
                    <label for="f_peritacion" class="text-right middle">Fecha Peritación</label>
                </div>
                <div class="small-3 cell">
                    <input id="f_peritacion" name="f_peritacion" type="date" value="<?= date("Y-m-d"); ?>" required>
                </div>
            </div>

            <div class="grid-x grid-padding-x">
                <!-- Compañía -->
                <div class="small-1 cell">
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
                <div class="small-2 cell">
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
                <div class="small-2 cell">
                    <label for="estado" class="text-right middle">Estado</label>
                </div>
                <div class="small-3 cell">
                    <select name="estadoId" id="estado" required>
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

            <div class="cell">
                <button type="submit" class="button tiny" id="btGrabar" name="grabar_peritacion"><i class="fas fa-plus"></i> Añadir peritacion</button>
            </div>
        </fieldset>
    </div>

</form>