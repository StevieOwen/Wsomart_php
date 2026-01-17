<?php

    function generate_token(){
        $tokencreatedAt = new DateTime();
        $tokenexpiresAt = new DateTime();
        $tokenexpiresAt =clone $tokencreatedAt;
        $tokenexpiresAt->modify('+30 minutes');
        
        $token=random_int(100000,999999);
        $created_at=$tokencreatedAt->format('Y-m-d H:i:s');
        $expires_at=$tokenexpiresAt->format('Y-m-d H:i:s');
        return [$token, $created_at,$expires_at];
    }

?>