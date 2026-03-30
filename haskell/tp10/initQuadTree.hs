data Qtree a = Leaf a | Node (Qtree a) (Qtree a) (Qtree a) (Qtree a)
         deriving (Show, Ord, Eq)

q1 = (Node (Node (Leaf 11) (Leaf 12) (Leaf 13) (Leaf 14)) (Leaf 2) (Leaf 3) (Leaf 4))
q2 = (Node (Leaf 1) (Leaf 2) (Node (Leaf 31) (Leaf 32) (Node (Leaf 331) (Leaf 332) (Leaf 333) (Leaf 334)) (Leaf 34)) (Leaf 4))

-- ———————————————————————————————————————
--
-- 1. Traitement récursif des quadtrees (cas général)
--

vecDe :: Int -> a -> [a]
vecDe n x = [x | i <- [1..n]]

f :: Show a => a -> String
f x = "Leaf " ++ show x ++ " "

showQtree :: Show a => (Qtree a) -> String
showQtree qs = showqt qs 0
showqt :: Show a => (Qtree a) -> Int -> String
showqt (Leaf x) i           = (vecDe i ' ') ++ (f x) ++ "\n"
showqt (Node (Leaf x1) (Leaf x2) (Leaf x3) (Leaf x4)) i
                            = (vecDe i ' ') ++ "Node " ++ concat (map f [x1,x2,x3,x4])++"\n"
showqt (Node nw ne sw se) i = (vecDe i ' ') ++ "Node \n"
                                    ++ showqt nw (i+4)
                                    ++ showqt ne (i+4)
                                    ++ showqt sw (i+4)
                                    ++ showqt se (i+4)
