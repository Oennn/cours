import java.util.*;

public class Main {
    public static void main(String[] args) {
        ArrayList<String> al=new ArrayList<>();
        al.add("A");
        al.add("B");
        al.add("C");
        AfficheurIterator.afficheElements(al.iterator());
        System.out.println("\n");

        MyArrayListIterator<String> list= new MyArrayListIterator<>(al);
        list.next();
        list.remove();
        while (list.hasNext()){
            System.out.println(list.next());
        }System.out.println("\n");

        MyArrayList<String> liste = new MyArrayList<>();
        liste.add("A");
        liste.add("B");
        liste.add("C");

        for (String s : liste) {
            System.out.println(s);
        }System.out.println("\n");

        MyArrayList2<String> liste2 = new MyArrayList2<>();
        liste2.add("A");
        liste2.add("B");
        liste2.add("C");

        System.out.println("Itérateur normal :");
        for (String s : liste) {
            System.out.println(s);
        }

        System.out.println("Itérateur inversé :");
        Iterator<String> reverseIter = liste2.reverseIterator();
        while (reverseIter.hasNext()) {
            System.out.println(reverseIter.next());
        }
    }
}
