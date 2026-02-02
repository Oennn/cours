import java.util.*;

public class MyArrayList2<E> extends ArrayList<E> {


    public Iterator<E> reverseIterator() {
        return new MyArrayListReverseIterator<>(this);
    }
}
