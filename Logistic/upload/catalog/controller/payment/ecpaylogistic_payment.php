<?php
$al_shipping_code = '';
if (isset($_SESSION["shipping_methods"]["ecpaylogistic"]) && isset($_SESSION["shipping_method"]["code"])) {
        $al_shipping_code = $_SESSION["shipping_method"]["code"];
} else {
        foreach ($_SESSION as $key => $value) {
                if (isset($_SESSION[$key]["shipping_methods"]["ecpaylogistic"]) && isset($_SESSION[$key]["shipping_method"]["code"])) {
                        $al_shipping_code = $_SESSION[$key]["shipping_method"]["code"];
                }
        }
}
if($al_shipping_code == "ecpaylogistic.unimart_collection" || $al_shipping_code == "ecpaylogistic.fami_collection" || $al_shipping_code == "ecpaylogistic.hilife_collection"){
?>
        <script type="text/javascript">
        <!--
        $(document).ready(function(){
                $( "input[name$='payment_method']" ).each(function( index ) {
                        if($( this ).val() != 'ecpaylogistic'){
                                $( this ).remove();
                        } else {
                                $( this ).attr('checked',true);
                        }
                });
         });
        //-->
        </script>
<?php } ?>