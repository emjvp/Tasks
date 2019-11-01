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
                <th scope="row">E-MAIL:</th>
                <td colspan="2">  <?php echo $this->data["email"]; ?></td>
            </tr>
            <tr>
                <th scope="row">TELEFONO:</th>
                <td colspan="2"><?php echo $this->data["telefono"]; ?></td>
            </tr>
            <tr>
                <th scope="row">ASUNTO:</th>
                <td colspan="2"><?php echo $this->data["asunto"]; ?></td>
            </tr>
            <tr>
                <th scope="row" >MENSAJE:</th>
                <td colspan="2"><?php echo $this->data["mensaje"]; ?></td>
            </tr>
        </tbody>
    </table>
</div>