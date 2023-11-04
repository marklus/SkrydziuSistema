# SkrydziuSistema
Grupinis darbas "P170B114 Informacinių sistemų pagrindai"

1) Visual code atsisiųsti is "code.visualstudio.com"
2) Visual code Extension skiltyje(tie kvadratelei) suinstaliuoti "PHP intelephense", "PHP Server" jei dar nėra
3) Atsisiųsti github app "https://desktop.github.com/" ir loginint, kad su duombaze dirbti atsisiųsti xampp "https://www.apachefriends.org/download.html"             
4) Teigiant kad jau prisijunges prie github repositorijos esi pagal įdėja turėtų ją leisti klonuoti
   4.1) Github appe "File" -----> "Clone repository" 
5) Visual code "Welcome" screene apačioje start spausti "Open Folder" ---->  pas mane cia "C:\Users\Martynas\Documents\GitHub\SkrydziuSistema" pas jus kur nustatet location step 4

6) Dabar paleidziame XAMPP programoje Apache ir MySQL
7) Patikrinimui ar veikia pagal įdėją visual code atidarytam folderį yra index.php failas spaudžiam ant jo ir tada ten kur rasomas jo kodas spaužiam pelės dešnį "PHP: Server Open FIle in Browser" turėtų atidaryti default browseri langą prisijungimo
    kredencialai yra duombazėje "users" table slaptažodis užhashintas berods tai as naudoju admin username: kazkas password: kazkas Arba sita user username: kazkas1 password: kazkas  gali registruotis jei bazę pavyko prijunkti

8) Jei duombazės nepavyko prijungti nes metą error kad nepavyksta connection daryti projekto include folderį pakeiskit
    define("DB_USER", "root");
define("DB_PASS", "");

Pas mane ant xamppo šitie yra default bet ant to kur duoda tame modulyje default yra stud stud tai
