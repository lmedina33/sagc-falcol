<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace models\entidades;
/**
 * Description of MediaType
 *
 * @author Carlos
 */
abstract class MediaType extends BasicEnum{
    //put your code here
    const video = 1;
    const audio = 2;
    const text = 3;
    const sheet = 4;
    const apresentation = 5;
}
