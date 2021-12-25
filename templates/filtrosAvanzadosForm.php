<form id="filtrosAvanzadosForm" style="display: none;">

    <div class="grid-x grid-margin-x grid-padding-x">
        <fieldset class="cell text-center callout fieldset1">
            <legend><strong><i class="fas fa-search"></i> Filtros avanzados</strong></legend>

            <div class="grid-x grid-padding-x">
                <div class="cell small-8">
                    <!-- filtro compañías -->
                    <div class="grid-x grid-margin-x grid-padding-x">
                        <fieldset class="cell text-center callout">
                            <legend><i class="far fa-building"></i> Compañías</legend>
                            <div class="grid-x">

                                <?

                                    use Companias\Companias;

                                    $companias = (new Companias())->getCompanias();
                                    $comp_name = array_column($companias, 'nombre');
                                    array_multisort($comp_name, SORT_ASC, $companias);
                                    foreach ($companias as $comp) {
                                        $id = $comp['id'];
                                        $name = $comp['nombre'];
                                        echo "<div class='small-5 medium-6 large-3 cell'>
                                                            <div class='grid-x'>
                                                            <div class='small-9 cell text-right'>
                                                                <label for='ckeckCompany{$id}Filter' style='margin-right: 5px;'>$name</label>
                                                            </div>
                                                            <div class='small-3 cell text-left'>
                                                                <div class='switch tiny'>
                                                                    <input class='switch-input filterCheck' id='ckeckCompany{$id}Filter' type='checkbox' name='checkCompania_$id'>
                                                                    <label class='switch-paddle' for='ckeckCompany{$id}Filter'>
                                                                        <span class='show-for-sr'>$name activo</span>
                                                                        <span class='switch-active' aria-hidden='true'>SI</span>
                                                                        <span class='switch-inactive' aria-hidden='true'>NO</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>";
                                    }

                                ?>

                            </div>
                        </fieldset>
                    </div>
                </div>


                <div class="cell small-4">
                    <!-- filtro peritos -->
                    <div class="grid-x grid-margin-x grid-padding-x">
                        <fieldset class="cell text-center callout">
                            <legend><i class="fas fa-running"></i> Peritos</legend>
                            <div class="grid-x">

                                <?

                                use Peritos\Peritos;

                                $peritos = (new Peritos())->getPeritos();
                                $comp_name = array_column($peritos, 'nombre');
                                array_multisort($comp_name, SORT_ASC, $peritos);
                                foreach ($peritos as $comp) {
                                    $id = $comp['id'];
                                    $name = $comp['nombre'];
                                    echo "<div class='small-5 cell'>
                                                        <div class='grid-x'>
                                                        <div class='small-9 cell text-right'>
                                                            <label for='ckeckPerito{$id}Filter' style='margin-right: 5px;'>$name</label>
                                                        </div>
                                                        <div class='small-3 cell text-left'>
                                                            <div class='switch tiny'>
                                                                <input class='switch-input filterCheck' id='ckeckPerito{$id}Filter' type='checkbox' name='checkPerito_$id'>
                                                                <label class='switch-paddle' for='ckeckPerito{$id}Filter'>
                                                                    <span class='show-for-sr'>$name activo</span>
                                                                    <span class='switch-active' aria-hidden='true'>SI</span>
                                                                    <span class='switch-inactive' aria-hidden='true'>NO</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>";
                                }

                                ?>

                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="cell">
                    <div class="grid-x grid-margin-x grid-padding-x">
                        <div class="small-6 cell">
                            <!-- filtro fecha cierre -->
                            <div class="grid-x">
                                <fieldset class="cell text-center callout">
                                    <legend><i class="far fa-calendar-alt"></i> Fecha creación peritación</legend>
                                    <div class="grid-x">
                                        <div class="small-5 cell text-left">
                                            <input id="f_creac_desde" name="f_creac_desde" class="inputFilter" type="date" value="">
                                        </div>
                                        <div class="small-2 cell text-center middle">
                                            A
                                        </div>
                                        <div class="small-5 cell text-right">
                                            <input id="f_creac_hasta" name="f_creac_hasta" class="inputFilter" type="date" value="">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="small-6 cell">
                            <!-- filtro fecha cierre -->
                            <div class="grid-x">
                                <fieldset class="cell text-center callout">
                                    <legend><i class="far fa-calendar-alt"></i> Fecha cierre peritación</legend>
                                    <div class="grid-x">
                                        <div class="small-5 cell text-left">
                                            <input id="f_cierr_desde" name="f_cierr_desde" class="inputFilter" type="date" value="">
                                        </div>
                                        <div class="small-2 cell text-center middle">
                                            A
                                        </div>
                                        <div class="small-5 cell text-right">
                                            <input id="f_cierr_hasta" name="f_cierr_hasta" class="inputFilter" type="date" value="">
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cell">
                <button class="button" type="submit"><i class="fas fa-search"></i> Aplicar filtros</button>
                <button class="button alert" id="resetFilter"><i class="fas fa-trash"></i> Borrar filtros</button>
            </div>
        </fieldset>
    </div>

</form>