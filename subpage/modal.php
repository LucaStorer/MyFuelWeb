
<!-------------------------------------------MODAL NUOVO --------------------------------------->

<div class="modal modal-purple" id="ModalNew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Nuovo Rifornimento</h4>
        </div>
        <div class="modal-body">
          <form role="form" data-dpmaxz-eid="1" action="Database/interopMyDB.php" name="insert" method="post">

            <div class="form-group">
              <label class="control-label">Nome *</label>
              <input type="text" class="form-control" name="nome" placeholder="Nome del prodotto" data-dpmaxz-eid="2" required>
              <label class="control-label">Marca</label>
              <input type="text" class="form-control" name="marca" placeholder="marca" data-dpmaxz-eid="3">

            </div>
            <div class="form-group">
              <div class="col-lg-6">

                <label class="control-label">prezzo Unitario €</label>
                <div class="input-group">
                  <span class="input-group-addon">€</span>
                  <input type="number" step=0.01 class="form-control" name="prezzo" placeholder="Euro" data-dpmaxz-eid="2" value="0.0">
                </div>
              </div>
              <div class="col-lg-6">
                <label class="control-label">U.M.</label>
                <select class="form-control" name="um" data-dpmaxz-eid="4" placeholder="Unità di misura">
                  <option value="PZ">PZ</option>
                  <option value="KG">KG</option>
                  <option value="L">L</option>
                  <option value="g">g</option>
                </select>
              </div>
              <!--  <label class="control-label">In Uso</label>
              <select class="form-control" name="in_uso" data-dpmaxz-eid="4" required="">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
            </select>-->
          </div>
          <label class="control-label">Categoria</label>
          <select class="form-control" name="categoria" data-dpmaxz-eid="4" required="">
            <?php

            $rs_resultSelect = selectreqCUSTOM("liste","CATEGORIA","PRODOTTI");
            while($rowSelect = $rs_resultSelect->fetch_assoc()) {
              ?>
              <option value="<?echo $rowSelect["VALUE"]; ?>"><?echo $rowSelect["ALIAS"]; ?></option>
              <?php
            };
            ?>
          </select>
        </div>

        <div class="modal-footer">
          <!--  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-outline" name="insertprodotto">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!---------------------------------------------------------------------------------------------->

<!-------------------------------------------MODAL MODIFICA ------------------------------------>
<div class="modal modal-purple" id="ModalUpdate">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Modifica Rifornimento</h4>
        </div>
        <div class="modal-body">
              <form role="form" data-dpmaxz-eid="1" action="Database/interopMyDB.php" name="update" method="post">

            <div class="form-group">
              <input type="text" class="from-control" name="idrecord" id="idrecord" hidden data-dpmaxz-eid="1">
              <label class="control-label">Nome *</label>
              <input type="text" class="form-control" name="nome" placeholder="Nome del prodotto" data-dpmaxz-eid="2" required>
              <label class="control-label">Marca</label>
              <input type="text" class="form-control" name="marca" placeholder="marca" data-dpmaxz-eid="3">

              <div class="col-lg-6">

                <label class="control-label">prezzo Unitario €</label>
                <div class="input-group">
                  <span class="input-group-addon">€</span>
                  <input type="number" step=0.01 class="form-control" name="prezzo" placeholder="Euro" data-dpmaxz-eid="2" value="0.0">
                </div>
              </div>
              <div class="col-lg-6">
                <label class="control-label">U.M.</label>
                <select class="form-control" name="um" data-dpmaxz-eid="4" placeholder="Unità di misura">
                  <option value="PZ">PZ</option>
                  <option value="KG">KG</option>
                  <option value="L">L</option>
                  <option value="g">g</option>
                </select>
              </div>
              <!--  <label class="control-label">In Uso</label>
              <select class="form-control" name="in_uso" data-dpmaxz-eid="4" required="">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
            </select> -->

            <label class="control-label">Categoria</label>
            <select class="form-control" name="categoria" data-dpmaxz-eid="4" required="">
              <?php

              $rs_resultSelect = selectreqCUSTOM("liste","CATEGORIA","PRODOTTI");
              while($rowSelect = $rs_resultSelect->fetch_assoc()) {
                ?>
                <option value="<?echo $rowSelect["VALUE"]; ?>"><?echo $rowSelect["ALIAS"]; ?></option>
                <?php
              };
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <!--  <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-outline" name="updateprodotto">Save changes</button>
          <button type="submit" class="btn pull-left btn-danger"  data-dpmaxz-eid="6" name="deleteprodotto"><i class="fa fa-trash-o"></i> ELIMINA</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<!---------------------------------------------------------------------------------------------->
