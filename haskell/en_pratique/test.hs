-- aide
{-

C:\Users\Neoch\Documents\haskell\en_pratique
ghci test.hs
    :q, :r, :t
ghc test.hs
./test.exe



facto :: Int -> Int 
facto 0=1
facto n=n* (facto(n-1))

combinaison :: Int ->Int -> Int
(+):: Int -> Int -> Int
((+)5)9
(+5)9 c est equivalent
((-)5)9

combinaison k n =(facto n) `div` (facto k)* (facto(n-k))

div 8 2
:t div
8 `div` 2 comme dessus


parmi :: Int -> Int -> Int
parmi = combinaison 

ecrire en infixe : (2 `parmi` 5) 
c'est equivalent a (parmi 5 5)

[1,2,3,4]
(4:[]) renvoie [4]
(2:(3:(4:[]))) renvoie [2,3,4]
:t (:) renvoie (:) :: a -> [a] -> [a]


[2*k | k <- [0..5]] veut dire je veux l'ensemble des 2 *k pour k appartenant à l ensemble 0 à 5
renvoie [0,2,4,6,8,10]

['a'..'z']


(2*) <$> [0..10] renvoie [0,2,4,6,8,10,12,14,16,18,20] car multiplie la liste par 2

:t (<$>) renvoie (<$>) :: Functor f => (a -> b) -> f a -> f b

(:[]) 0 renvoie [0]

(:[]) <$> [1,2,3,4] renvoie [[1],[2],[3],[4]]

length liste renvoie la taille = 5



x <- reste veut dire x appartient au reste
reste = [1,2,3]
[x*2 | x <- reste]
renvoie [2,4,6]


(filter) :: (a -> Bool) -> [a] -> [a]
filter (==5) [1,2,5,8,7] renvoie [5]


-- (\) = fonction anonyme
-- mot -> mot == triRapide mot ( est ce que le mot est égal au triRapide du mot)


and :: Foldable t => t Bool -> Bool
-}

import Debug.Trace





-- Safe head pour éviter les warnings
headSafe :: [a] -> a
headSafe (x:_) = x
headSafe []    = error "Liste vide !"  -- message clair si liste vide


tailSafe :: [a] -> [a]
tailSafe (_:xs) = xs       -- si la liste n’est pas vide, renvoie le reste
tailSafe []     = []       -- si la liste est vide, renvoie liste vide




-----------------------------------------------------------------------
-- definition des arguments


-- Liste et variables
liste :: [Int]
liste = [1,2,3,4,5]

a :: Int
a = 5

b :: Int
b = 2

c :: Double
c = 10.1




-----------------------------------------------------------------------
-- Fonction 




double :: Num a => a -> a
double x = x * 2


estPair :: Integral a => a -> IO ()
estPair x = 
    if x `mod` 2 == 0
       then putStrLn "Pair !"
       else putStrLn "Impair !"





facto :: Int -> Int 
facto 0=1
facto n=n* (facto(n-1))
combinaison :: Int ->Int -> Int
combinaison k n =(facto n) `div` ((facto k)* (facto(n-k)))



parmi :: Int -> Int -> Int
parmi = combinaison


-- renvoie nb de liste triées de taille n et d alphabet de taille k
s:: Int -> Int -> Int
s n k = n `parmi` (n+k-1)


-- renvoie une liste de mots de taille n et d alphabet [[0,k-1]]
mots:: Int -> Int -> [[Int]]
mots 1 k= (:[]) <$> [0..(k-1)] -- mots 1 10 renvoie [[0],[1],[2],[3],[4],[5],[6],[7],[8],[9]]
mots n k = [ (nouveauNb:motPetit) | nouveauNb <- [0..(k-1)], motPetit <- mots (n-1 ) k]


triRapide :: (Ord a) => [a] -> [a]
triRapide []= []
triRapide (pivot:reste) = triRapide([x | x <- reste, x < pivot]) 
                        ++ [pivot] 
                        ++ (triRapide [x | x <- reste, x>= pivot])

-- renvoie nb de liste triées de taille n et d alphabet de taille k
motsTries :: Int -> Int -> [[Int]]
motsTries n k = filter (\mot -> mot == triRapide mot) (mots n k)

--test la fonction s pour quelques valeur de n et de k
test :: Int -> Int -> Bool
-- test n k = and [s i j == length (motsTries i j) | i <- [1..n], j <- [1..k]]
test n k = and [ trace (show i ++ "," ++ show j ++ " -> " ++ show (s i j)) 
                     (s i j == length (motsTries i j)) 
               | i <- [1..n], j <- [1..k]]




-----------------------------------------------------------------------