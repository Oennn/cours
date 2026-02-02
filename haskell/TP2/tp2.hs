main :: IO ()
main = do
    putStrLn ("hello")
laugh:: Int->String
laugh n
  |n==0 =""
  |otherwise = "HA " ++(laugh (n-1))

laugh2:: Int->String
laugh2 n=if(n==0)then "" else "HA " ++(laugh2 (n-1))

allEven::[Int]->Bool
allEven []=True
allEven (x:xs)= (even x)&&(allEven xs)

double::[String]->String
double (x:xs)= x++" " ++ x++" " ++ double xs

myZip::[Int]->String->[(Int,Char)]
myZip [] _=[]
myZip _ []=[] 
myZip (x:xs) (y:ys)=(x,y) : myZip xs ys

split::[a]->([a],[a])
split[]=([],[])
split[a]=([a],[])
split (x:y:xs)=(x:pair,y:impair)
  where
    (pair,impair)=split xs

unsplit :: ([a],[a]) -> [a]
unsplit ([], []) = []
unsplit (x:xs, []) = x : unsplit (xs, [])
unsplit ([], y:ys) = y : unsplit ([], ys)
unsplit (x:xs, y:ys) = x : y : unsplit (xs, ys)


collatz :: Int -> Int
collatz n
  | n == 2        = 1 --pas utile
  | even n        = n `div` 2
  | otherwise     = 3 * n + 1

nbCalls::Int->Int
nbCalls n
  |n==1 =0
  |otherwise =1+nbCalls(collatz n)

syracuse :: Int -> [Int]
syracuse n
  | n == 1    = []
  | otherwise = n : syracuse (collatz n)

hamming :: String -> String -> Int
hamming [] [] = 0
hamming [] (_:ys) = 1 + hamming [] ys
hamming (_:xs) [] = 1 + hamming xs []
hamming (x:xs) (y:ys)
  | x /= y    = 1 + hamming xs ys
  | otherwise = hamming xs ys


bouge::String->String->String
bouge x y ="de "++ x++" vers "++y 


hanoi :: String -> String -> String -> Int -> [String]
hanoi origine but aux 0 = []
hanoi origine but aux n =
  hanoi origine aux but (n-1) ++
  [bouge origine but] ++
  hanoi aux but origine (n-1)

  
nb_repetitions :: Int -> [Int] -> Int --Haskell ne peut pas savoir si le type a supporte ==
nb_repetitions x [] = 0
nb_repetitions x (y:ys)
  | x == y    = 1 + nb_repetitions x ys
  | otherwise = 0


compacte :: [Int] -> [Int]

compacte [] = []
compacte (x:xs) =
  let n = nb_repetitions x (x:xs)
      reste = drop n (x:xs)
  in n : x : compacte reste

decompacte :: [Int] -> [Int]
decompacte [] = []
decompacte (n:x:rest) = replicate n x ++ decompacte rest
decompacte _ = error "Liste incorrecte"

{-

decompacte :: [Int] -> [Int]
decompacte [] = []
decompacte (n:x:rest)
  |n<=0 =decompacte rest
  |otherwise=x:decompacte((n-1):x:rest)

-}

suite :: Int -> [Int]
suite 1 = [1]
suite n= compacte (suite (n-1))

