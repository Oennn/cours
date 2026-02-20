public class ListeDoublementChainee<T> {
    private CelluleDouble<T> tete;
    private CelluleDouble<T> queue;

    public ListeDoublementChainee() {
        tete = null;
        queue = null;
    }

    public void ajouterEnQueue(T valeur) {
        CelluleDouble<T> nouvelle = new CelluleDouble<>(valeur);

        if (tete == null) {
            tete = nouvelle;
            queue = nouvelle;
            return;
        }

        queue.suivant = nouvelle;
        nouvelle.precedent = queue;
        queue = nouvelle;
    }


    public void ajouterEnTete(T valeur){
        CelluleDouble<T> nouvelle = new CelluleDouble<>(valeur);
        if(tete==null){
            tete=nouvelle;
            queue=nouvelle;
        }
        else{
            nouvelle.suivant=tete;
            tete.precedent =nouvelle;
            tete=nouvelle;
        }
    }
    public boolean isHere(T valeur){
        return ref(valeur)!=null;
    }


    public CelluleDouble<T> ref(T valeur){
        CelluleDouble<T> courant=tete;
        if(tete==null){
            return null;
        }
        while(courant.suivant!=null){
            if(courant.valeur==null){
                return courant;
            }
            if(valeur.equals(courant.valeur)){
                return courant;
            }
            courant=courant.suivant;
        }

        return null;
    }
    public boolean retirer(T valeur) {
    CelluleDouble<T> aRetirer = ref(valeur);

    if (aRetirer == null) return false; // valeur non trouvée

    // 1) Cas : suppression de la tête
    if (aRetirer == tete) {
        tete = tete.suivant;
        if (tete != null) {
            tete.precedent = null;
        } else {
            // liste devenue vide
            queue = null;
        }
        return true;
    }

    // 2) Cas : suppression de la queue
    if (aRetirer == queue) {
        queue = queue.precedent;
        queue.suivant = null;
        return true;
    }

    // 3) Cas : suppression au milieu
    aRetirer.precedent.suivant = aRetirer.suivant;
    aRetirer.suivant.precedent = aRetirer.precedent;
 

    return true;
    }

    
    public boolean insertionV2DerriereV1(T v1, T v2) {
    // 1) trouver la cellule contenant v2
    CelluleDouble<T> c = ref(v2);

    // 2) si v2 n'existe pas, on ne fait rien
    if (c == null) {
        return false;
    }

    // 3) créer la nouvelle cellule v1
    CelluleDouble<T> nouvelle = new CelluleDouble<>(v1);

    // 4) cas où v2 est la queue (on ajoute en queue)
    if (c == queue) {
        c.suivant = nouvelle;
        nouvelle.precedent = c;
        queue = nouvelle;
        return true;
    }

    // 5) cas général (au milieu)
    CelluleDouble<T> suivant = c.suivant;

    c.suivant = nouvelle;
    nouvelle.precedent = c;

    nouvelle.suivant = suivant;
    suivant.precedent = nouvelle;

    return true;
    }



    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        CelluleDouble<T> courant = tete;

        while (courant != null) {
            sb.append("<- ").append(courant.valeur).append(" -> ");
            courant = courant.suivant;
        }

        sb.append("null");
        return sb.toString();
    }

}
