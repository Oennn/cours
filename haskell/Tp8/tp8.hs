data Btree a= Nil
            | Bin a (Btree a) (Btree a)
            deriving (Show, Eq, Ord)

voir :: (Show a) => (Btree a) -> IO()
voir t = putStr (visuTree t)
visuTree :: Show a => Btree a -> String
visuTree t = visu t 1
  where visu Nil n = ""
        visu (Bin y t1 t2) n = (visu t1 (n+5)) ++
                               [' ' | _ <- [1..n]] ++ (show y) ++ ['\n'] ++
                               (visu t2 (n+5))

a1 = (Bin 4 (Bin 3 (Bin 2 Nil Nil) Nil) (Bin 7 (Bin 6 Nil Nil) (Bin 8 Nil Nil)))
a2 = (Bin 4 (Bin 3 (Bin 1 Nil Nil) Nil) (Bin 8 (Bin 7 Nil Nil) (Bin 11 (Bin 9 Nil Nil) Nil)))
a3 = (Bin 40 (Bin 30 (Bin 20 (Bin 15 Nil Nil) (Bin 25 Nil Nil)) (Bin 35 Nil Nil)) (Bin 70 (Bin 60 (Bin 50 (Bin 45 Nil Nil) Nil) (Bin 65 Nil Nil)) (Bin 80 Nil Nil)))
a4 = (Bin 10 a1 a3)
a5 = (Bin 17 a1 a3)

profondeur:: Btree a -> Int
profondeur Nil = 0
profondeur (Bin _ Nil Nil) = 0
profondeur (Bin _ t1 t2)= 1 + max(profondeur t1) (profondeur t2)

prefixe, infixe, postfixe :: Btree a->[a]
prefixe Nil = []
prefixe (Bin x t1 t2) = [x] ++ prefixe t1 ++ prefixe t2

infixe Nil=[]
infixe (Bin x t1 t2)= infixe t1 ++ [x] ++ infixe t2

postfixe Nil=[]
postfixe (Bin x t1 t2)= postfixe t1 ++ postfixe t2 ++ [x]

inBtree :: Ord a => a -> Btree a -> Bool
inBtree x Nil = False
inBtree x (Bin y t1 t2)
  | x==y = True
  | x > y = inBtree x t2
  | otherwise = inBtree x t1

insere:: Ord a=>a -> Btree a ->Btree a
insere x Nil = Bin x Nil Nil
insere x (Bin y t1 t2)
  | x > y = Bin y t1 (insere x t2)
  |otherwise=Bin y (insere x t1) t2


list2abr :: Ord a => [a] -> (Btree a)
list2abr [] = Nil
list2abr (x:xs) = insere x (list2abr xs)

trier :: Ord a=> [a]->[a]
trier xs = infixe (list2abr xs)

path :: Ord a => Btree a -> a -> [a]
path (Bin t Nil Nil) _=[t]
path (Bin t t1 t2) x
  |x<t =t: (path t1 x)
  | x> t = t : (path t2 x)
  |otherwise = [x]

estEquilibre :: Btree a -> Bool
estEquilibre Nil = True
estEquilibre (Bin _ t1 t2) = (abs (profondeur t1 - profondeur t2) <= 1)
                           && estEquilibre t1
                           && estEquilibre t2
-- profondeur parcourt tout le sous-arbre (O(n)) à chaque nœud,
-- puis estEquilibre descend récursivement et re-appelle profondeur
-- sur les mêmes sous-arbres déjà parcourus → calculs redondants → O(n²)

sommeArbre:: Num a=>Btree a->a
sommeArbre Nil=0
sommeArbre (Bin t t1 t2)= t + sommeArbre t1 + sommeArbre t2

minArbre,maxArbre:: Btree a -> a
minArbre (Bin t Nil _)=t
minArbre (Bin _ t1 _)= minArbre t1


maxArbre (Bin t _ Nil) = t
maxArbre (Bin _ _ t2)  = maxArbre t2

join :: Btree Integer -> Btree Integer -> Btree Integer
join t1 Nil = t1
join Nil t2 = t2
join (Bin x u1 u2) t2 = Bin x u1 (join u2 t2)


delete :: Integer -> Btree Integer -> Btree Integer
delete x Nil = Nil
delete x (Bin y t1 t2)
 | x < y = Bin y (delete x t1) t2
 | x > y = Bin y t1 (delete x t2)
 | otherwise = join t1 t2

deleteMin:: Btree Integer->Btree Integer
deleteMin Nil = Nil
deleteMin t= delete (minArbre t ) t

deleteMax:: Btree Integer->Btree Integer
deleteMax Nil = Nil
deleteMax t= delete (maxArbre t ) t


delete1 :: Ord a => a -> Btree a -> Btree a
delete1 _ Nil = Nil
delete1 x (Bin y t1 t2)
  | x < y     = Bin y (delete1 x t1) t2
  | x > y     = Bin y t1 (delete1 x t2)
  | otherwise  = supprRacine t1 t2
  where
    supprRacine Nil t2  = t2
    supprRacine t1  Nil = t1
    supprRacine t1  t2
      | profondeur t1 >= profondeur t2 =
          let m = maxArbre t1
          in Bin m (delete1 m t1) t2
      | otherwise =
          let m = minArbre t2
          in Bin m t1 (delete1 m t2)
