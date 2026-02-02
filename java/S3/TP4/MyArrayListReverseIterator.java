import java.util.*;


public class MyArrayListReverseIterator<E> implements Iterator<E> {

    private MyArrayList2<E> liste;
    private int index;
    private boolean cantRemove;

    public MyArrayListReverseIterator(MyArrayList2<E> liste) {
        this.liste = liste;
        this.index = liste.size() - 1;
        this.cantRemove=true;
    }


    public boolean hasNext() {
        return index >= 0;
    }


    public E next() {
        if (!hasNext()) {
            throw new  IllegalStateException();
        }
        E elem = liste.get(index);
        index--;
        cantRemove=false;
        return elem;
    }


    public void remove(){
            if(cantRemove){
                throw new  UnsupportedOperationException("opération non implémentée");
            }
            liste.remove(index - 1);
            index--;
            cantRemove=true;

    }
}
