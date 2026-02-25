appartient :: Eq a => [a] -> a -> Bool
appartient[] _ = False
appartient(x:xs) elem
  | x == elem = True
  | otherwise = appartient xs elem
union :: Eq a => [a] -> [a] -> [a]
union xs [] = xs
union (x:xs) ys
  | appartient ys x = union xs ys
  | otherwise = x : union xs ys


estAlpha,estAlpha2::Char->Bool
estAlpha a = elem a ['a'..'z'] || elem a ['A'..'Z']

estAlpha2 a = appartient ['a'..'z'] a  || appartient ['A'..'Z'] a

filtreAlphas::String->String
filtreAlphas x = filter (estAlpha) x

rmChar:: Char->String->String
rmChar c s= filter (/=c) s

{-
auDessus:: Int->[Int]->[Int]
auDessus _ []=[]
auDessus x (y:xs)
  | x> y = auDessus x xs
  |otherwise = y: auDessus x xs

-}

auDessus:: Int->[Int]->[Int]
auDessus _ []=[]
auDessus a x= filter (estSup)  x
  where estSup = \y -> y>a



rmEgaux :: [(Int, Int)] -> [(Int, Int)]
rmEgaux xs = filter (couple) xs
  where couple= \(a,b) -> a /= b

rmChar2:: Char->String->String
rmChar2 c s= [x | x<-s, x/=c]

produitRec,produitFold :: [Int] -> Int
produitRec []=1
produitRec (x:xs)= x* produitRec xs
produitFold x= foldr (*) 1 x


etLogiqueRec,etLogiqueFold :: [Bool] -> Bool
etLogiqueRec []= True
etLogiqueRec (x:xs)= x && etLogiqueRec xs


etLogiqueFold= foldr (&&) True


concatRec,concatFold :: [[a]] -> [a]
concatRec []=[]
concatRec (x:xs)= x ++ concatRec xs

concatFold = foldr (++) []

rmCharsRec,rmCharsFold :: String -> String -> String
rmCharsRec _ []=[]
rmCharsRec s x= filter (`notElem` s) x

rmCharsFold s x= foldr (\c acc -> if notElem c s then c:acc else acc) [] x
--c  = caractere de l iteration, acc = ce qu on a deja construit depuis la droite, imaginer que l'on commence depuis la fin de la liste donc au depart acc = [] puis 'e' puis "ne" ...