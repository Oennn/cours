factNT, factT :: Int -> Int
factNT 0 = 1 -- 1er cas de base
factNT n = n * factNT (n-1) -- cas r´ecursif

factT n = factAux n 1
  where
    factAux :: Int -> Int -> Int
    factAux 0 acc = acc -- cas de base
    factAux n acc = factAux (n-1) (acc * n) -- cas recursif



main::IO()
main = do
  -- fact
  let x = (factT ((2::Int)^(26::Int)))
  print x

puissanceNT::Integer -> Integer -> Integer
puissanceNT a 0 = 1
puissanceNT a b
  | even b = puissanceNT (a*a) (b `div` 2)
  | otherwise = a * puissanceNT a (b-1)

puissanceT :: Integer -> Integer -> Integer
puissanceT a b = aux a b 1
  where
    aux _ 0 acc = acc
    aux a b acc = aux a (b-1) (acc * a)



mystery :: [Int] -> [Int]
mystery [] = []
mystery (x:xs) = mystery [y | y <- xs, y <= x]
                    ++ [x]
                    ++ mystery [y | y <- xs, y > x]
-- trie en ordre croissant

{-
triInsert :: [Int] -> [Int]
triInsert [] = []
triInsert (x:xs) = inserer x (triInsert xs)
  where
    inserer x [] = [x]
    inserer x (y:ys)
      | x <= y    = x : y : ys
      | otherwise = y : inserer x ys

-}

sommeCarrePairs:: Int-> Int
sommeCarrePairs 0 = 0
sommeCarrePairs n = sommeCarrePairs (n-1) + (2*n)^2

moitiePairs:: [Int]-> [Int]
moitiePairs n = [div i 2|i<-n,even  i]

dansPlage::Int->Int->[Int]->[Int]
dansPlage a b c= [i |i<-c,i>=a && i<= b]

compterPositifs:: [Int]->Int
compterPositifs a = length [i |i<-a,i>0]


compterPositifsRec:: [Int]->Int
compterPositifsRec [] = 0
compterPositifsRec (x:xs)
  |x>0= 1+ compterPositifsRec xs
  |otherwise = compterPositifsRec xs


occurrencePos:: String-> Char->[Int]
occurrencePos [] _=[]
occurrencePos s c= [i | (x,i)<- zip s [0..], x==c]

prefix:: String -> String -> Bool
prefix _ []= True
prefix [] _=False
prefix (a:as) (b:bs)
  |a==b = prefix as bs
  |otherwise = False


contient:: String -> String -> Bool
contient _ []= True
contient [] _=False
contient s1 s2
  |prefix s1 s2 =True
  |otherwise = contient (tail s1) s2