<?php
$dicoprix = array(
"jambon" => 3,
"sauce_tomate" => 1.5,
"poivrons" => 2,
"oignons" => 1,
"champignons" => 2,
"mozzarella" => 1.5,
"creme_fraiche" => 1.5,
"chevre" => 2,
"tomates" => 2,
"lardons" => 2.5,
"saumon" => 4,
"merguez" => 3
);
$monDicoPizzas = array(
"reine" => ["jambon","mozzarella","sauce_tomate","champignons"],
"vesuvio" => ["merguez","jambon","mozzarella","poivrons","oignons"],
"cabri" => ["chevre","lardons","creme_fraiche","mozzarella"],
"napoli" => ["jambon","tomates","mozzarella","sauce_tomate",
"champignons","poivrons","oignons"],
"neptune" => ["saumon","creme_fraiche","champignons"]
);

/*
foreach ($dicoprix as $ingredient => $prix) {
    echo "$ingredient coûte $prix euros\n";
}if(isset($tab2[$ingredient])) pour regarder si dans tab2 on a le meme ingredient, en partant du meme type de tableau pour les 2
$tab2[$ingredient] renvoie la clé, un int ici
    */
function combien(array $dico): int{
    return count($dico);

}
echo"Nombre d'ingrédients = ".combien($dicoprix);
/*
function combien(array $dico): int {
    $cpt = 0;
    foreach ($dico as $value) {
        $cpt++;
    }
    return $cpt;
}
*/
function prix_moyen(array $dico): float{
    return array_sum($dico)/count($dico);
}
echo"\nPrix moyen =";
print_r(round(prix_moyen($dicoprix),2));


function moinscher(array $dico): array{
    $mini=min($dico);
    $resultat=[];
    foreach($dico as $x=>$y){
        if($mini === $y){
            $resultat[]=$x;
        }
    }
    return $resultat;
}
echo"\nIngredients les moins chères = ".moinscher($dicoprix)[0]."\n";



function dollars(array &$dico): void{
    $taux= 1.12;
    foreach($dico as $x=>$y){
        $dico[$x]=$y*$taux;
    }
}

$dicoDollars=$dicoprix;
echo"\nprix de euro à dollars : ";
dollars($dicoDollars);
print_r($dicoDollars);

function prixpizza(array $liste_ingredients, array $dicoprix): float{
    $somme=0;

    foreach($liste_ingredients as $x){

        $somme+=$dicoprix[$x];
        
    
    }
    
    return $somme;
}

foreach($monDicoPizzas as $pizza=>$ingredients){
    echo"\nPrix $pizza = ". 1.5*prixpizza($ingredients, $dicoprix)."\n";
}




function gestion(array $dicoprix1, array $dicoprix2): array{


    foreach($dicoprix1 as $dico=> $prix){
        if(array_key_exists($dico, $dicoprix2) ){
            if($prix < $dicoprix2[$dico]){
                $dicoprix2[$dico]=$prix;
            }
        }
        
    }
    return $dicoprix2;

}



$dicoprix2 = array(
"jambon" => 3.2,
"sauce_tomate" => 1.4,
"poivrons" => 2.1,
"oignons" => 0.95,
"champignons" => 2.0,
"mozzarella" => 1.6,
"creme_fraiche" => 1.4,
"chevre" => 2.2,
"tomates" => 1.9,
"lardons" => 2.7,
"saumon" => 4.0,
"merguez" => 2.9,
"anchois" => 2.3
);
echo "\n";
$res=gestion($dicoprix, $dicoprix2);

echo"Nombre total d'ingredients apres fusion = ".count($res)."\n";
echo"Prix retenu pour oignons = ".$res["oignons"]."\n";
echo"Prix retenu pour merguez = ".$res["merguez"]."\n";
echo"Prix retenu pour sauce_tomate = ".$res["sauce_tomate"]."\n";
echo"Prix retenu pour anchois = ".$res["anchois"]."\n";


function possible(array $dicopizzas, float $val, array $dicoprix): array{
    $sum=0;
    $tab=[];
    
    foreach($dicopizzas as $dico => $ingredient){

        $sum=prixpizza($ingredient,$dicoprix);

        if($val >=$sum){
            echo "$sum\n";
            $tab[]=$dico;
        }
        
    }
    return $tab;
}

print_r(possible($monDicoPizzas, 12, $dicoprix));

function fusion($dicoprix, $dicopizzas):array{
    $tab=[];
    foreach($dicopizzas as $dico =>$ingredients){
        $prix=0;
        foreach($ingredients as $ingredient){
            $prix+=$dicoprix[$ingredient];
        }

        $tab[$dico]=[
            "ingredients" => $ingredients,
            "prix" => $prix
        ];

    }


    return $tab;
}
$nouveauDico = fusion($dicoprix, $monDicoPizzas);
print_r($nouveauDico);


function affichage(array $menu): void {
    echo "Menu des pizzas :\n";

    foreach ($menu as $nomPizza => $infos) {
        $prix = $infos["prix"];
        $ingredients = implode("/", $infos["ingredients"]);

        echo "* Pizza $nomPizza : $prix euros -- $ingredients\n";
    }
}

    
$menu = fusion($dicoprix, $monDicoPizzas);
affichage($menu);


function inter(array $l1, array $l2): bool{

    foreach($l1 as $arg1){
        foreach($l2 as $arg2){
            if($arg1===$arg2)
                return true;
        }
    }    
    return false;
}

function sansAllergie($monDicoPizzas, $listeallergenes){
    $liste=[];
    foreach($monDicoPizzas as $pizza => $ingredients){
        // $pizza = nom de la pizza
        // $ingredients = liste des ingrédients
        if(!inter($ingredients,$listeallergenes)){
            $liste[]= $pizza;
        }
    }
    return $liste;
}

$listeallergenes = [ "saumon"];

$resultat = sansAllergie($monDicoPizzas, $listeallergenes);
print_r($resultat);
/*
$monDicoPizzas=array(
                          "reine"=>["jambon","mozarella","saucetomate","champignons"],
                          "vesuvio"=>['merguez','jambon','mozarella','poivrons','oignons'],
                          "cabri"=>["chevre","lardons","cremefraiche","mozarella"],
                          "napoli"=>["jambon","tomates","mozarella","saucetomate","champignons","poivrons","oignons"],
                          "neptune"=>['saumon','cremefraiche','champignons']);

($monDicoPizzas as $pizza => $ingredients)
$ingredients = liste des ingrédients
$pizza = nom de la pizza
($ingredients as $ingredient)
$ingredient = ingredient seul



$nouveauDico = [
    "reine" => [
        "ingredients" => ["jambon","mozarella","saucetomate","champignons"],
        "prix" => 12
    ],
    "vesuvio" => [
        "ingredients" => ["merguez","jambon","mozarella","poivrons","oignons"],
        "prix" => 15
    ],
    ...
];
$nouveauDico["reine"] renvoie : 
[
  "ingredients" => ["jambon","mozarella","saucetomate","champignons"],
  "prix" => 12
]

$prixReine = $nouveauDico["reine"]["prix"]; renvoie prix

$ingredientsReine = $nouveauDico["reine"]["ingredients"]; renvoie ingredients

acceder a un ingredient précis : 
$premierIngredient = $nouveauDico["reine"]["ingredients"][0]; // "jambon"
$dernierIngredient = $nouveauDico["reine"]["ingredients"][3]; // "champignons"


Chercher un ingrédient précis dans toutes les pizzas
quelles pizzas contiennent "champignons" ?
2 foreach nécessaires (pizzas → ingrédients)

foreach ($dico as $pizza => $ingredients) {
        foreach ($ingredients as $ingredient)

selon:
foreach ($dicoTest as $nomPizza => $infos) 
dicoTest=
[
  "reine" => [ //$pizza
      "ingredients" => [...], //$infos[ingredients] donne juste la liste
      "prix" => 8.5 //$infos[prix] donne juste le prix, C’est strictement équivalent à $dicoTest[$nomPizza]["prix"];
  ],
  ...
]
Récupérer le prix d’une pizza:
$prixPizza = $dicoTest["$pizza"]["prix"]; avec prix defini

Récupérer la liste des ingrédients
$ingredientsPizza = $dicoTest["pizza"]["ingredients"]; avec ingredients defini


Vérifier si une pizza contient un ingrédient précis
if (in_array("jambon", $dicoTest["pizza"]["ingredients"])) {
    echo "La pizza reine contient du jambon";
}




Récupérer toutes les pizzas qui contiennent un ingrédient
$pizzasAvecJambon = [];
foreach pour une liste d ingredients, et remplacer jambon par $ingredientListe
foreach ($dicoTest as $nomPizza => $infos) {
    if (in_array("jambon", $infos["ingredients"])) {
        $pizzasAvecJambon[] = $nomPizza;
    }
}
*/
?>