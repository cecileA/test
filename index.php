<form action="telecharger.php">
Choisir la pièce que vous souhaitez obtenir
<?php echo liste_deroulante("pieces1.xml");
?>
<br />Puis cliquez sur [télécharger]
<input type="submit" value="Télécharger"/> <br /><br />
</form>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Chargement du fichier xml
function liste_deroulante($fichier_XML)
{ 
    if (file_exists($fichier_XML))
    { 
        $ma_liste = simplexml_load_file($fichier_XML); 
    }
    else
    {
        $ma_liste = simplexml_load_string('<liste name="erreur">
                                            <ligne><value>0</value>
                                            <label>Erreur - Le fichier est manquant !</label>
                                            </ligne></liste>');
    
        
    }
    //Création de la liste
    $name = $ma_liste->attributes()->name;
    $listed = '<select name="'.$name.'">';
    foreach($ma_liste->children() as $ligne)
    {
        $select ='';
        if($ligne->attributes()->selected == 'true')
        { 
            $select = ' selected="selected" '; 
        }
        $listed .= '<option '.$select.'value="'.$ligne->value.'">';
        $listed .= $ligne->label.'</option>';
    }
    $listed .= '</select>';
    return $listed; 
}