<?php
namespace App;
use App\Entity\Phrase;
class PhraseGenerator
{
    public function getRandomPhrase()
    {
        /**
         * Selecting male or female noun
         * 0 - male, 1 - female
         */
        $sexArray = [0, 1];
        
        $sex = $this->random_value($sexArray);


        /**
         * Selecting how many adwerbs to use
         *
         */
        $adjectiveArray = [0, 1, 2, 3, 4];
        $adjectiveNumber = $this->random_value($adjectiveArray);


        
        return $this->formRandomPhrase($sex,$adjectiveNumber);
        
    }

    public function formRandomPhrase($sex,$adjectiveNumber){

        $phrase = new Phrase();
        
        $string = "";
        $emoticons = ["a", "ach", "aha", "ak", "ai", "cit", "e", "ehe", "ei", "ek", "ė", "hm", "na", "o", 'oho',
         "oi", "ša", "ts", "ačiū", 'bravo', "deja", 'dėkui', "marš", "sveiks", 'štiš', 'vai', 'vaje', 'valio', 'labas', 'sudie'];

    
        
        //adjectives array 0 -male, 1-female
        $adjectives = array (
            ["aštrus", "aukštas" ,"blogas","bukas","didelis","geras","gražus","greitas","gudrus","ilgas","jaunas","kantrus",
        "karštas","kietas","kreivas","kvailas","lėtas","lieknas","linksmas","liūdnas","mandagus","mažas","mielas",'minkštas',"murzinas",
        "naujas", "piktas","pilnas","platus","plonas","protingas",'šaltas', 'senas','siauras',"silpnas",
        "šiltas","stambus",'stiprus',"storas","švarus",'tiesus','trumpas','tuščias', "vėsus",'žemas','vyriškas',"moteriškas",'malonus'],

        ["aštri", "aukšta" ,"bloga","buka","didelė","gera","graži","greita","gudri","ilga","jauna","kantri",
        "karšta","kieta","kreiva","kvaila","lėta","liekna","linksma","liūdna","mandagi","maža","miela",'minkšta',"murzina",
        "nauja", "pikta","pilna","plati","plona","protinga",'šalta', 'sena','siaura',"silpna",
        "šilta","stambi",'stipri',"stora","švari",'tiesi','trumpa','tuščia', "vėsi",'žema','vyriška',"moteriška",'maloni']
          );
        
        
        $noun = array (
            [ "stalas", "laikrodis", "langas", "namas", "kelias", "suolas", "takas", 'sapnas', 'vardas', 'vaikas'],

            ["lenta", "gėlė", "kėdė", "mašina", 'moteris', "gyvatė", "svajonė", 'pėlė', 'mintis']
          );
      

        //add emoticon 
        $string.=$this->random_value($emoticons)." ";

        //add adjectives
    
        for($i=0;$i<$adjectiveNumber;$i++){
            $adjective = $this->random_value($adjectives[$sex]);
            while(strpos($string, $adjective) === true) {
                $adjective =$this->random_value($adjectives[$sex]);
            }
            if($i===0){
                $string.=$adjective;
            }else{
                $string.=" ".$adjective;
            }
            if($adjectiveNumber==1){
                $string.=",";
            }
            if(($i+1)!==$adjectiveNumber){
                $string.=",";
            }else{
                $string.=" ";
            }
        }
       
        
        //add noun

        $string.=$this->random_value($noun[$sex])."!";
        $phrase = new Phrase();
        $phrase->setUrl($this->unique_url());
        $phrase->setPhrase($string);
        $phrase->setColor($this->rand_color());
       return $phrase;

    }
    function random_value($array, $default=null)
    {
        $k = mt_rand(0, count($array) - 1);
        return isset($array[$k])? $array[$k]: $default;
    }

    function rand_color() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }



    function unique_url($l = 8) {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }
}