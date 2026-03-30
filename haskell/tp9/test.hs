type Ensemble a= [a]
type Assoc k v=[(k,v)]

find :: Eq k => k -> Assoc k v -> v
find k [] = error "Not found"
find k t = head [v | (k', v ) <- t, k == k']


test :: Eq a => a -> Ensemble a -> Bool
test a []= False
test a b = elem a b



type Matrice = [[Int]]

estMatrice :: Matrice -> Bool
estMatrice [] = False
estMatrice (ligne0:lignes)
  | null ligne0 = False
  | otherwise   = all (\ligne -> length ligne == length ligne0) lignes


uniforme:: [Int ]->Bool
uniforme [] = True
uniforme (a:ax)= all (== a) ax

uniforme2:: [Int]->Bool

uniforme2 []=True
uniforme2 [_]= True --1 seul element
uniforme2 (a:b:ax)
  | a ==b = uniforme2 (b:ax)
  |otherwise = False

uniformeFold :: [Int] -> Bool
uniformeFold [] = True
uniformeFold (a:xs) = foldr (\x acc -> (x == a) && acc) True xs --acc vaut initialement True, 2e arg de foldr, puis change selon chaque valeur de la liste

uniformeMap :: [Int] -> Bool
uniformeMap [] = True
uniformeMap (x:xs) = and (map (==x) xs) -- ou all True (map (\a -> x==a) xs)     ou         and (map (\a -> x==a) xs)


valide :: Matrice -> Bool
valide [] = False
valide (ligne0:lignes)
  | null ligne0 = False
  | otherwise   = uniforme (map length (ligne0:lignes))

myZipWith :: (a -> b -> c) -> [a] -> [b] -> [c]
myZipWith f xs ys = map (uncurry f) (zip xs ys)

plusM:: Matrice->Matrice->Matrice
plusM [] [] = []
plusM (a:ax) (b:bx)
  |length a /= length b =error "dim incompatible (col)"
  |otherwise =myZipWith (+) a b :plusM ax bx
plusM _ _ = error "dim incompatible (ligne)" --pour plusM [] (b:bx)          ou          plusM (a:ax) []

data Booleen = Vrai | Faux
data Montype = Valeur1 | Valeur2 | Valeur3

data Deplacement = Haut | Bas | Gauche | Droite
type Position = (Int,Int) -- des positions sur un plan de deux dimensions

deplace:: Deplacement-> Position->Position
deplace Gauche (x , y) = (x - 1, y)
deplace Droite (x , y) = (x + 1, y)
deplace Haut (x , y) = (x , y + 1)
deplace Bas (x , y) = (x , y - 1)

deplaces :: [Deplacement]-> Position->Position
deplaces [] p = p
deplaces (a:ax) p = deplaces ax (deplace a p)

flipe :: Deplacement -> Deplacement
flipe Gauche = Droite
flipe Droite = Gauche
flipe Haut = Bas
flipe Bas = Haut

maxTuple :: (Int, Int) -> (Int, Int) -> Int
maxTuple x y = max (max (fst x) (snd x)) (max (fst y) (snd y))

sommePetitEntiers:: [(Int,Int)] -> Int
sommePetitEntiers [] = 0
sommePetitEntiers (x:xs) = min (fst x) (snd x)  + sommePetitEntiers xs