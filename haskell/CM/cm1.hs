estIdentiqueBis :: Double -> Bool
estIdentiqueBis n = abs ((sqrt n) * (sqrt n) - n) < 1/10^10

{-

§ Caractères (type Char)
> 'a' ==> 'a'
> 'A' < 'a' ==> True
> succ 'b' ==> 'c'
> pred 'z' ==> 'y'

Liste d’entiers : type [Int]
> [1..5] ==> [1,2,3,4,5]
> [1,4..10] ==> [1,4,7,10]
> [2+3, 7-4, div 72 7, 23] ==> [5,3,10,23]

div 5 2
5/2
 [1 < 2, True, 'a'=='b'] => [True,True,False]

§ ++ : concatène deux listes. ===========liste ++ [4]
§ : : ajoute un élément en tête d’une liste. ============4:liste
§ !! : accède à un élément d’une liste en utilisant son index ========== "hello" !! 1 donne e


============================================
§ String et [Char] sont des types synonymes

===================================================

Tuples
> (2^5, True || False, 'a') ==> (32, True, 'a')
> (pi/2, 'A' < 'a') ==> (1.5707963267948966, True)
> ("Lundi", 9, "Janvier", 2018) ==> ("Lundi", 9, "Janvier", 2018)

=================================================================

§ Des combinaisons de la plupart des symboles sont autorisées comme opérateur

x +/- y = (x+y, x-y)
> 22 +/- 90
(112,-68)


head (1:(reverse [2,3,4,5]))

========================


let <déclarations locales>
in <expression utilisant ces déclarations>
let : introduit des variables locales ou des fonctions temporaires.

in : indique où ces variables/fonctions sont utilisées.

let x = 3
    y = 4
in x + y
x = 3 et y = 4 sont déclarés localement.

L’expression finale x + y donne :

7

===============

f = y+z -- fonction, le where rend le tout plus lisible
 where y = 1+2
       z = 4+6
where est réservé pour faire une construction
syntaxique
==================================

if expression then expression else expression : contrairement au langage impératif le else est
obligatoire
plusPetit x y = if (x < y) then x
 else y
=============================
case of :
troisPremiers x = case x of
 1 -> "A"
 2 -> "B"
 3 -> "C"
 _ -> "*" -- pattern-matching pour le choix par défaut (voir plus tard)

=============================================

dansIntervalle z x y = if (z < x) && (z < y) then -1
 else if (x < z) && (z < y) then 0
 else if (x < z) && (y < z) then 1
 else -2


version raccourcie
Utilisation des gardes :
 dansIntervalle z x y
 | (z < x) && (z < y) = -1
 | (x < z) && (z < y) = 0
 | (x < z) && (y < z) = 1
 | otherwise = -2




liste= [1..10]
sum (2:liste) => 57

filter (>10) l
==========================================
-}




returne :: p -> p -- c’est une fonction qui prend une valeur de type p et retourne une valeur du même type p.
returne a= a
echanger (a,b)= (b,a) 
troisPremiers x = case x of
 1 -> "A"
 2 -> "B"
 3 -> "C"
 _ -> "*" -- pattern-matching pour le choix par défaut (voir plus tard)


annualNetSalaryCalc tarif heure
    | form < 20000 ="nul "++show form
    | form < 50000 ="bien "++show form
    | form < 90000 ="tb "++show form
    | otherwise ="rend l'argent"
    where 
        form = tarif * (heure * 52)

l:: [Int]
l = [1,2,3,4]
lT=[sListe,sListeCarre]
    where
        sListe= sum(l)
        sListeCarre= sum(map(^2)l)



{-l = [1,2,3,4]

lT = [ sum l
     , sum (map (^2) l)
     ]
lT = [ sum l
     , sum [x^2 | x <- l] --va check chaque elements de l
     ]

-}
prod []=1
prod (a:xs) = a*(prod xs)
{-
prod [2,3,4,5]
= 2 * prod [3,4,5]
= 2 * (3 * prod [4,5])
= 2 * (3 * (4 * prod [5]))
= 2 * (3 * (4 * (5 * prod [])))
= 2 * (3 * (4 * (5 * 1)))   -- prod [] = 1
= 2 * (3 * (4 * 5))
= 2 * (3 * 20)
= 2 * 60
= 120

======================

tousPairs :: [Int] -> Bool
tousPairs l 
    | all even l =True
    |otherwise = False
    where 
        l = [x^2 | x <- l]

-}
tousPairs :: [Int] -> Bool
tousPairs a 
    | all even l =True
    |otherwise = False
    where 
        l = [x^2 | x <- a]