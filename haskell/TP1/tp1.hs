main :: IO ()
main = do
    putStrLn ("hello")


-- runghc -Wall tp1.hs


-- 1. 20 * 3
-- Multiplication d'entier


-- 2. (*) 20 3
-- Les opérateurs sont des fonctions en Haskell
-- (*) est la fonction multiplication appliquée à 20 et 3
-- Résultat : 60

-- 3. 22 + 10 * 2
-- La multiplication est prioritaire sur l’addition
-- Résultat : 42

-- 4. 1 == 2
-- Test d’égalité entre deux entiers
-- Résultat : False

-- 5. 2 + (-2)
-- Addition avec un nombre négatif
-- Résultat : 0

-- 6. [1..10]
-- Liste d’entiers de 1 à 10 inclus
-- Résultat : [1,2,3,4,5,6,7,8,9,10]

-- 7. [1.0, 1.25..2.0]
-- Liste de nombres flottants avec un pas de 0.25
-- Résultat : [1.0,1.25,1.5,1.75,2.0]

-- 8. [1, 4..15]
-- Liste d’entiers avec un pas de 3
-- Résultat : [1,4,7,10,13]

-- 9. [1.0..1.8]
-- Liste de flottants avec un pas implicite de 1.0
-- la valeur 2.0 est incluse même si elle dépasse 1.8
-- Résultat : [1.0,2.0]

-- 10. 'F' < 'P'
-- Comparaison des caractères (Unicode)
-- Résultat : True

-- 11. "FPhaskell" < "FPH"
-- Comparaison des chaînes caractère par caractère
-- Résultat : False

-- 12. div 1 2
-- Division entière (quotient)
-- Résultat : 0

-- 13. 21 / 2
-- Division réelle 
-- Résultat : 10.5

-- 14. 4 `div` 2
-- div en notation infixe (avec des backticks)
-- Résultat : 2

-- 15. 3 > 4 || 5 < 6 && not (7 /= 8)
-- && est prioritaire sur ||
-- 3 > 4 = False
-- 5 < 6 = True
-- 7 /= 8 = True donc not True = False
-- Résultat : False

-- 16. 10 + if even 20 then 2 else 3
-- Expression conditionnelle regarde si 20est pair, ajoute 2 sinon 3 à 10
-- Résultat : 12

f:: Int->Int --fonction affine
f x = 2 * x + 1 
-- f 1 et f -1


g:: Int ->Double --applique f à x ensuite multiplie par 2.1
g x = 2.1 * fromIntegral(f x) --converti en double
-- g 1 et g (-1)


h :: Int -> Int -> Int --calcule si y est au moins 2* plus grand ?
h x y = 2*x - y 
-- h 4 1 et h (-1) 0

-- erreurs sur le xs qui etait mal placé (pas au niveau du a)
-- le typage de a (num) ? ca devrait poser un probleme car xs est un int, mais apparement non. faut typer la fonction.
-- ainsi que les '' qui doivent etre ``
--correction :
n::Int
n = a `div` length xs
  where
    a = 10
    xs = [1 ,2 ,3 ,4 ,5]



square:: Int->Int
square n = n*n

sumSquare:: Int-> Int-> Int
sumSquare a b= square a + square b

sumSquaresMax:: Int-> Int -> Int -> Int
sumSquaresMax a b c=
  let mid= a+b+c - (maximum [a,b,c] + minimum [a,b,c])
  in sumSquare (maximum [a,b,c]) mid

f2c :: Double -> Double
f2c f = (5 / 9) * (f - 32)


travelExpenses :: Int -> Int -> Double
travelExpenses km nb
  | nb >= 2  && nb <= 4  = fromIntegral (km*nb) * 0.52 * 0.75
  | nb >= 5  && nb <= 10 = fromIntegral (km*nb) * 0.52 * 0.50
  | nb >= 11             = fromIntegral (km*nb) * 0.52 * 0.25
  | otherwise            = fromIntegral (km*nb) * 0.52


decode :: Int -> Char
decode n = toEnum n 
code :: Char -> Int
code c = fromEnum c


nextUpperCase :: Char -> Char
nextUpperCase c
  |c == 'Z' ='A'
  |otherwise = succ c

nextUpperCase2 :: Char -> Char
nextUpperCase2 c= if (c == 'Z') then 'A' 
                  else decode (code c + 1)


isTriple :: Int -> Int -> Int -> Bool
isTriple a b c = a^2 + b^2 == c^2


leg1 :: Int -> Int -> Int
leg1 x y = x*x - y*y

leg2 :: Int -> Int -> Int
leg2 x y = 2 * x * y

hyp :: Int -> Int -> Int
hyp x y = x*x + y*y

pytest :: Int -> Int -> (Int, Int, Int)
pytest x y = (leg1 x y, leg2 x y, hyp x y)

addCarre:: Int-> Int->Int
addCarre x y = a+b
  where
    a= x*x
    b=y*y

parite:: String ->Bool
parite a = if(even (length a)) then True else False

test:: String->String->Bool
test a b = a == b

test:: String




