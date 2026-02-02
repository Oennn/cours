import java.util.*;
public class MyArrayListIterator<E> implements Iterator<E>{
    private ArrayList<E> list;
    private int index;
    private boolean cantRemove = true;
    public MyArrayListIterator(ArrayList<E> list){
        this.list=list;
        this.index = 0;
        this.cantRemove = true;
    }
    
    public boolean hasNext(){
        return index < list.size();
    }
    public E next(){
        if(!hasNext()){
            throw new  IllegalStateException();
        }
        E elem=list.get(index);
        index++;
        cantRemove=false;
        return elem;
    }
    public void remove(){
        if(cantRemove){
            throw new  UnsupportedOperationException("opération non implémentée");
        }
        list.remove(index - 1);
        index--;
        cantRemove=true;

    }



}
