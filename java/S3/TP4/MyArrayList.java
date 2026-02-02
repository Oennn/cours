import java.util.*;
public class MyArrayList<E> extends ArrayList<E>{
    public Iterator<E> iterator(){
        return new MyArrayListIterator<>(this);
    }

}