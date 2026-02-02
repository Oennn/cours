-- aide
{-
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
parmi = combinaison pour ecrire en ifixe : 2 `parmi` 5

[1,2,3,4]
(4:[]) renvoie [4]
(2:(3:(4:[]))) renvoie [2,3,4]
:t (:) renvoie (:) :: a -> [a] -> [a]
-}







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
combinaison :: Int ->(Int -> Int)
combinaison k n =(facto n) `div` ((facto k)* (facto(n-k)))



parmi :: Int -> Int -> Int
parmi = combinaison


-- renvoie nb de liste triées de taille n et d alphabet de taille k
s:: Int -> Int -> Int
s n k = n `parmi` (n+k-1)


-- renvoie une liste de mots de taille n et d alphabet [[0,k-1]]
mots:: Int -> Int -> [[Int]]
mots n k=



-----------------------------------------------------------------------

-- Main pour tester headSafe
main :: IO ()
main = do
    putStrLn ("Premier élément : " ++ show (headSafe liste))
    putStrLn ("Reste de la liste : " ++ show (tailSafe liste))
    putStrLn ("facto: " ++ show (facto 5))
    putStrLn ("combi == parmi : " ++ show (2 `parmi` 5 ))
    putStrLn ("s : " ++ show (s 5 5 ))

