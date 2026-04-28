
-- TP9 : Représentation d'images à l’aide des quadtrees
-- Réponses en Haskell
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

-- ============================
-- 1. Définition du quadtree
-- ============================

data Qtree a = Leaf a | Node (Qtree a) (Qtree a) (Qtree a) (Qtree a)
  deriving (Show, Ord, Eq)

-- Nombre de feuilles
nbLeaf :: Qtree a -> Int
nbLeaf (Leaf _) = 1
nbLeaf (Node nw ne sw se) =
  nbLeaf nw + nbLeaf ne + nbLeaf sw + nbLeaf se

-- Nombre de noeuds internes
nbNoeuds :: Qtree a -> Int
nbNoeuds (Leaf _) = 0
nbNoeuds (Node nw ne sw se) =
  1 + nbNoeuds nw + nbNoeuds ne + nbNoeuds sw + nbNoeuds se

-- Profondeur du quadtree
profondeur :: Qtree a -> Int
profondeur (Leaf _) = 0
profondeur (Node nw ne sw se) =
  1 + maximum [profondeur nw, profondeur ne, profondeur sw, profondeur se]


-- ============================
-- 2. Représentation d'image
-- ============================

data Pixel = B | N
  deriving (Show, Eq)

type Image = (Int, Qtree Pixel)

-- Affichage d'un pixel
showPixel :: Pixel -> Char
showPixel B = '*'
showPixel N = ' '


-- ============================
-- 3. Transformation d'image
-- ============================

-- Transposition du quadtree
transposeQtree :: Qtree a -> Qtree a
transposeQtree (Leaf x) = Leaf x
transposeQtree (Node nw ne sw se) =
  Node (transposeQtree nw)
       (transposeQtree sw)
       (transposeQtree ne)
       (transposeQtree se)

transposer :: Image -> Image
transposer (k, qt) = (k, transposeQtree qt)


-- Négatif d'image
reversePixel :: Pixel -> Pixel
reversePixel B = N
reversePixel N = B

reverseQtree :: Qtree Pixel -> Qtree Pixel
reverseQtree (Leaf p) = Leaf (reversePixel p)
reverseQtree (Node nw ne sw se) =
  Node (reverseQtree nw)
       (reverseQtree ne)
       (reverseQtree sw)
       (reverseQtree se)

reverseImage :: Image -> Image
reverseImage (k, qt) = (k, reverseQtree qt)


-- ============================
-- 4. Représentation matricielle
-- ============================

type Vecteur a = [a]
type Matrice a = [Vecteur a]

-- Affichage matrice
showMatrice :: Matrice Pixel -> String
showMatrice = unlines . map (map showPixel)

-- vecteur de n éléments x
vecteurDe :: Int -> a -> Vecteur a
vecteurDe n x = replicate n x

-- matrice n × n remplie avec x
matriceDe :: Int -> a -> Matrice a
matriceDe n x = replicate n (vecteurDe n x)


-- ============================
-- 5. Quadtree -> Matrice
-- ============================

fusionHoriz :: Matrice a -> Matrice a -> Matrice a
fusionHoriz = zipWith (++)

fusionVert :: Matrice a -> Matrice a -> Matrice a
fusionVert = (++)

qtToMat :: Int -> Qtree Pixel -> Matrice Pixel
qtToMat k (Leaf p) = matriceDe (2^k) p
qtToMat k (Node nw ne sw se) =
  let k2 = k - 1
      mNW = qtToMat k2 nw
      mNE = qtToMat k2 ne
      mSW = qtToMat k2 sw
      mSE = qtToMat k2 se
      haut = fusionHoriz mNW mNE
      bas  = fusionHoriz mSW mSE
  in fusionVert haut bas

qtreeToMatrice :: Image -> Matrice Pixel
qtreeToMatrice (k, qt) = qtToMat k qt


-- ============================
-- 6. Matrice -> Quadtree
-- ============================

-- transforme pixels en feuilles
pixelToLeaf :: Matrice Pixel -> Matrice (Qtree Pixel)
pixelToLeaf = map (map Leaf)

-- regroupe blocs 2x2 en Node
construit :: Matrice (Qtree Pixel) -> Matrice (Qtree Pixel)
construit [] = []
construit (r1:r2:rs) =
  combine r1 r2 : construit rs
  where
    combine (a:b:xs) (c:d:ys) =
      Node a b c d : combine xs ys
    combine _ _ = []

-- simplifie nodes identiques
regroupe :: Matrice (Qtree Pixel) -> Qtree Pixel
regroupe [[x]] = simplifie x
regroupe m = regroupe (construit m)

simplifie :: Qtree Pixel -> Qtree Pixel
simplifie (Node (Leaf a) (Leaf b) (Leaf c) (Leaf d))
  | a == b && b == c && c == d = Leaf a
simplifie (Node nw ne sw se) =
  Node (simplifie nw) (simplifie ne) (simplifie sw) (simplifie se)
simplifie x = x

-- taille k de l'image
taille :: Matrice a -> Int
taille m = round (logBase 2 (sqrt (fromIntegral (length m * length (head m)))))

-- matrice -> image
matriceToQtree :: Matrice Pixel -> Image
matriceToQtree xss =
  (taille xss, regroupe (construit (pixelToLeaf xss)))
