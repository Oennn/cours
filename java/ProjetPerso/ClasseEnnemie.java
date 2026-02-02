public enum ClasseEnnemie {
    


    ZOMBIE(120, 20),
    SQUELETTE(80, 30),
    ORC(100, 25);

    //pour pas changer les stats
    private final int pvBase;
    private final int attaqueBase;

    //constructeur d un enum est tjr private
    ClasseEnnemie(int pvBase, int attaqueBase) {
        this.pvBase = pvBase;
        this.attaqueBase = attaqueBase;
    }

    public int getPvBase() {
        return pvBase;
    }

    public int getAttaqueBase() {
        return attaqueBase;
    }
    
}