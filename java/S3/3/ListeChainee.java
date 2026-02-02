import java.util.Iterator;

public class ListeChainee<T> implements Iterable<T>{
    private Cellule<T> tete;
    private Cellule<T> queue;
    public ListeChainee() {
        this.tete = null;
        this.queue=null;
    }
    // Constructeur avec un premier élément


    public void ajouterEnTete(T valeur) {
        Cellule<T> nouvelle = new Cellule<>(valeur);
        nouvelle.suivant = tete;
        tete = nouvelle;
        if (queue == null) {      // liste était vide avant l'ajout
        queue = nouvelle;     // la queue doit pointer sur le nouvel élément
    }
    }/* 
    public int ajoutetEnQueue(T valeur){
        int cpt=0;
        Cellule<T> nouvelle=new Cellule<>(valeur);
        Cellule<T> courant=tete;
        if(courant != null){
            while(courant.suivant!=null){
                courant=courant.suivant;
                cpt++;
            }
            courant.suivant=nouvelle;
        }
        else{

            tete=nouvelle;
        }
        return cpt;
    }*/

        public void ajouterEnQueue(T valeur){

            Cellule<T> nouvelle=new Cellule<>(valeur);
            if(tete==null){
                tete=nouvelle;
                queue = nouvelle;
            }else{

            
            queue.suivant=nouvelle;
            queue = nouvelle;
            }

        }

    @Override
    public String toString() {
        StringBuilder sb = new StringBuilder();
        Cellule<T> courant = tete;

        while (courant != null) {
            sb.append(courant.valeur).append(" -> ");
            courant = courant.suivant;
        }

        sb.append("null");
        return sb.toString();
    }

    public boolean isHere(T valeur){
        return ref(valeur)!=null;
    }

    public Cellule<T> ref(T valeur){

        Cellule<T> courant=tete;
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
    public Iterator<T> iterator(){
        return new ListeChaineeIterator();
    }
    private class ListeChaineeIterator implements Iterator<T>{
        private Cellule<T> courant = tete;

        public boolean hasNext(){
            return courant!=null;
        }

        public T next(){
            if(!hasNext()){
                throw new java.util.NoSuchElementException();
            }
            T elem= courant.valeur;
            courant=courant.suivant;
            return elem;
        }


    }

}
