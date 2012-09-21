<?php

/*
 * Copyright (C) 2009-2012 Internet Neutral Exchange Association Limited.
 * All Rights Reserved.
 *
 * This file is part of IXP Manager.
 *
 * IXP Manager is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation, version v2.0 of the License.
 *
 * IXP Manager is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License v2.0
 * along with IXP Manager.  If not, see:
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */


/**
 * Form: adding / editing physical interfaces
 *
 * @author     Barry O'Donovan <barry@opensolutions.ie>
 * @category   INEX
 * @package    INEX_Form
 * @copyright  Copyright (c) 2009 - 2012, Internet Neutral Exchange Association Ltd
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU GPL V2.0
 */
class INEX_Form_Interface_Physical extends INEX_Form
{

    public function init()
    {
        $this->addElement( INEX_Form_Switch::getPopulatedSelect( 'switchid' ) );
        
        $switchPorts = $this->createElement( 'select', 'switchportid' );

        $switchPorts->setRequired( true )
            ->setRegisterInArrayValidator( false )
            ->setLabel( 'Port' )
            ->setAttrib( 'class', 'chzn-select span3' )
            ->addValidator( 'greaterThan', false, array( 'min' => 1 ) )
            ->setErrorMessages( array( 'Please select a switch port' ) );
        $this->addElement( $switchPorts );
        
        $virtualInterface = $this->createElement( 'hidden', 'virtualinterfaceid' );
        $this->addElement( $virtualInterface );

        $status = $this->createElement( 'select', 'status' );
        $status->setMultiOptions( \Entities\PhysicalInterface::$STATES )
            ->setRegisterInArrayValidator( true )
            ->setAttrib( 'class', 'chzn-select span3' )
            ->setLabel( 'Status' )
            ->setErrorMessages( array( 'Please set the status' ) );
        $this->addElement( $status );


        $speed = $this->createElement( 'select', 'speed' );
        $speed->setMultiOptions( \Entities\PhysicalInterface::$SPEED )
            ->setRegisterInArrayValidator( true )
            ->setAttrib( 'class', 'chzn-select span3' )
            ->setLabel( 'Speed' )
            ->setErrorMessages( array( 'Please set the speed' ) );
        $this->addElement( $speed );


        $duplex = $this->createElement( 'select', 'duplex' );
        $duplex->setMultiOptions( \Entities\PhysicalInterface::$DUPLEX )
            ->setRegisterInArrayValidator( true )
            ->setAttrib( 'class', 'chzn-select span3' )
            ->setLabel( 'Duplex' )
            ->setErrorMessages( array( 'Please set the duplex' ) );
        $this->addElement( $duplex );


        $monitorindex = $this->createElement( 'text', 'monitorindex' );
        $monitorindex->addValidator( 'int' )
            ->setLabel( 'Monitor Index' )
            ->setAttrib( 'class', 'span3' )
            ->addFilter( 'StringTrim' )
            ->addFilter( new OSS_Filter_StripSlashes() );
        $this->addElement( $monitorindex );


        $notes = $this->createElement( 'textarea', 'notes' );
        $notes->setLabel( 'Notes' )
            ->setRequired( false )
            ->setAttrib( 'class', 'span3' )
            ->addFilter( new OSS_Filter_StripSlashes() )
            ->setAttrib( 'cols', 60 )
            ->setAttrib( 'rows', 5 );
        $this->addElement( $notes );
        
        $this->addElement( self::createSubmitElement( 'submit', _( 'Add' ) ) );
        $this->addElement( $this->createCancelElement() );
        
        $preselectSwitchPort = $this->createElement( 'hidden', 'preselectSwitchPort' );
        $this->addElement( $preselectSwitchPort );
        
        $preselectPhysicalInterface = $this->createElement( 'hidden', 'preselectPhysicalInterface' );
        $this->addElement( $preselectPhysicalInterface );
        
    }
}
