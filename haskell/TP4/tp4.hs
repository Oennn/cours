appartenance:: Eq a=>a ->[a]->Bool
appartenance _ []= False
appartenance a (b:bx)
  | a==b = True
  |otherwise = appartenance a bx

suprDbl:: Eq a=>[a]->[a]
suprDbl []=[]
suprDbl (a:ax)
  |appartenance a ax = suprDbl ax
  |otherwise = a : suprDbl ax

question3::Ord a=>a->[a]->[a]
question3 _ [] = []
question3 a b
  | head b < a = question3 a (tail b)
  |otherwise = (head b) : question3 a (tail b)


inclusion:: Eq a => [a]->[a]->Bool
inclusion [] _=True
inclusion (a:ax) b
  | appartenance a b ==False = False
  |otherwise = inclusion ax b


intersec:: Eq a => [a]->[a]->[a]
intersec [] _=[]
intersec  _ []=[]
intersec (a:ax) b
  | appartenance a b = a:intersec ax (filter (/= a) b)
  |otherwise = intersec ax b

union_aux:: Eq a=> [a] ->[a]->[a]
union_aux [] b = b
union_aux (a:ax) b 
  |appartenance a b = a: union_aux ax (filter (/= a) b)
  |otherwise = a: union_aux ax b

union::Eq a => [a]->[a]->[a]
union a b= suprDbl (union_aux a b)

sommeIntersection:: (Num a,Eq a) => [a]->[a]-> a
sommeIntersection a b= sum(intersec a b)

calculerPrixPizza:: Double->Double->Double->Double
calculerPrixPizza p pg nb=p*pg*nb


calculerPrixPizzaGrande:: Double-> Double
calculerPrixPizzaGrande nb= calculerPrixPizza 12.99 1.5 nb

calculerPrixPizzaMoyenne:: Double-> Double
calculerPrixPizzaMoyenne nb= calculerPrixPizza 9.99 1.25 nb

calculerPrixPizzaPetite:: Double-> Double
calculerPrixPizzaPetite nb= calculerPrixPizza 7.99 1 nb

main :: IO ()
main = do
    let prixGrande = calculerPrixPizzaGrande 4     -- grande avec 4 garnitures
    let prixMoyenne = calculerPrixPizzaMoyenne 2   -- moyenne avec 2 garnitures
    let prixPetite = calculerPrixPizzaPetite 1     -- petite avec 1 garniture

    putStrLn ("Prix pizza grande (4 garnitures) = " ++ show prixGrande)
    putStrLn ("Prix pizza moyenne (2 garnitures) = " ++ show prixMoyenne)
    putStrLn ("Prix pizza petite (1 garniture) = " ++ show prixPetite)


--map (*2) [1..6] donne [2,4,6,8,10,12]
-- map (\x -> x:[]) [1..5] donne [[1],[2],[3],[4],[5]]
--map (\x -> [v | v <- x,even v] ) [[1,2,3],[4,5,6],[7,8,9]] donne [[2],[4,6],[8]]

caracSuivant :: String -> String
caracSuivant s = map (\c -> succ c) s

double :: [Int]->[Int]
double b = map (*2) b
 
f2cList:: [Float]->[Float]
f2cList f = map f2c f
  where
     f2c x= (x-32)/1.8
 

{-
f2cList:: [Float]->[Float]
f2cList f = map (\x-> (x-32)/1.8 ) f
caracSuivant :: String -> String
caracSuivant [] = []
caracSuivant (s:sx) = succ s : caracSuivant sx
 
 
 
caracSuivant :: String -> String
caracSuivant = map succ
-}
deleteAll:: Eq a => a-> [a]-> [a]
deleteAll e []=[]
deleteAll e (a:ax)
  | e == a = deleteAll e ax
  |otherwise = a: deleteAll e ax


numerote:: [a]->[(a,Int)]
numerote a =  zip a [1..]
--numerote xs = [ (x,i) | (x,i) <- zip xs [1..] ]

interleave :: a -> [a] -> [[a]]
interleave e [] = [[e]]
interleave e (x:xs)= (e:x:xs) : map (x:) (interleave e xs)

perms :: [a] -> [[a]]
perms [] = [[]]
perms (x:xs) = concatMap (interleave x) (perms xs)

--prends une fonction, puis une liste
--concatMap (\x -> [x,x]) [1,2] ->[1,1,2,2] 2 en 1
--map (\x -> [x,x]) [1,2]       ->[[1,1],[2,2]]
--concat [[1,1],[2,2]]          ->[1,1,2,2]
--concat [[1,2,3]]              ->[1,2,3]

--map (\x -> [[1]]) [[]] -> [[[1]]]
--map (\x -> [[1]]) [[2]]  ->[[[1]]]
--map (\x -> 1) [[]]     -> [1]
--map (\x -> 1) []         ->[]
--map (\x->[1]) []        ->[]
--concatMap (\x->[1]) [] -> [] la fonction doit renvoyer une liste