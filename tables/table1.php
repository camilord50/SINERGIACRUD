<style type="text/css">
    .table-wrapper {
  max-height: 80vh;
  overflow: auto;
  width: 100%;
  display:inline-block;
}
.table-wrapper th {
    position: sticky;
    top: 1px;
    background: #fff;
    color: black;
    text-align: center;
   }
   .notfirst:hover {
      background-color: #0000002e;
    }
</style>

<div class="table-responsive table-wrapper">
<table class="table table-bordered">
    <thead>
        <th style="text-align: center;">Tipo Documento</th>
        <th>Numero Documento</th>
        <th>Nombre 1</th>
        <th>Nombre 2</th>
        <th>Apellido 1</th>
        <th>Apellido 2</th>
        <th>Genero</th>
        <th>Departamento</th>
        <th>Municipio</th>

		<th colspan="2">Acciones</th>
    </thead>
    <tbody>
        <?php foreach ($datos as $datos2) { ?>
            <tr>
                <td style="text-align: center;"><b><?php $this->tipoDocumento($datos2['tipo_documento_id']); ?></b></td>
                <td><?php echo $datos2['numero_documento']; ?></td>
                <td><?php echo $datos2['nombre1']; ?></td>
                <td><?php echo $datos2['nombre2']; ?></td>
                <td><?php echo $datos2['apellido1']; ?></td>
                <td><?php echo $datos2['apellido2']; ?></td>
                <td><?php $this->tipoGenero($datos2['genero_id']); ?></td>
                <td><?php $this->buscarDepartamento($datos2['departamento_id']); ?></td>
                <td><?php $this->buscarMunicipio($datos2['municipio_id']); ?></td>

                <td style="text-align: center;">
                    <button class="btn btn-warning btn-sm" id="editarregistro" onclick="modalEditarPaciente(`<?php echo $datos2['id'];?>`)"><span class="fa fa-edit"></button></a>
                </td>
                <td style="text-align: center;">
                    <button class="btn btn-danger btn-sm" id="eliminaregistro" onclick="confirmarEliminarPaciente(`<?php echo $datos2['id'];?>`)"><span class="fa fa-trash"></button></a>
                </td>

            </tr>
        <?php }; ?>
    </tbody>
</table>
</div>