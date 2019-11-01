<div style="background: #F15A24; padding:50px;" align="center">
    <table  style="background: #FFFFFF;color:#00000; font-size:12px; font-family:Arial; padding:20px;" whitd="500">
        
        <tbody  align="left">
            <tr>
                <td colspan="2" align="center"><img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/skins/page/images/logo.png" alt=""> <br> </td>
            </tr>
            <tr>
            <tr>
                <th scope="row">NOMBRE:</th>
                <td><?php echo $this->data["nombre"]; ?> </td>
            </tr>
            <tr>
                <th scope="row">EMPRESA:</th>
                <td colspan="2">  <?php echo $this->data["empresa"]; ?></td>
            </tr>
            <tr>
                <th scope="row">ID:</th>
                <td colspan="2"><?php echo $this->data["id"]; ?></td>
            </tr>
            <tr>
                <th scope="row">PERSONA RESPONSABLE:</th>
                <td colspan="2"><?php echo $this->data["persona"]; ?></td>
            </tr>
            <tr>
                <th scope="row" >EMAIL:</th>
                <td colspan="2"><?php echo $this->data["email"]; ?></td>
            </tr>
            <tr>
                <th scope="row" >INDEX:</th>
                <td colspan="2"><?php echo $this->data["index"]; ?></td>
            </tr>
            <tr>
                <th scope="row" >TELÉFONO:</th>
                <td colspan="2"><?php echo $this->data["telefono"]; ?></td>
            </tr>
            <tr>
                <th scope="row" >CÓDIGO FEDEGOLF:</th>
                <td colspan="2"><?php echo $this->data["telefono"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>