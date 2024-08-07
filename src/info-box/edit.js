
import { __ } from '@wordpress/i18n';

import { useBlockProps, 
    RichText,
    AlignmentToolbar,
    BlockControls ,
    ColorPalette,
    InspectorControls,
    PlainText,
    InnerBlocks,
    useInnerBlocksProps,
    List,
    __experimentalLinkControl as LinkControl,    
} from '@wordpress/block-editor';

import { useState } from '@wordpress/element';

import './editor.scss';

import { Button, CheckboxControl, Modal, PanelBody, Popover, RadioControl, SelectControl, SlotFillProvider, TextControl, ToggleControl } from '@wordpress/components';

import { TabPanel } from '@wordpress/components';

import { createBlock } from '@wordpress/blocks'
import classnames from 'classnames';

import { useSelect, useDispatch, withSelect, withDispatch, AsyncModeProvider } from '@wordpress/data'
import { compose } from '@wordpress/compose'
import GlobalInspector from '../Inspector/GlobalInspector';
import {inspectorsData} from './block.json'

export default function Edit({ attributes, setAttributes, isSelected, hasChild }) {

    // const { attributes, setAttributes } = props;
    const {contents } = attributes;

    const onChangeContent = ( newContent ) => {
        setAttributes( { content: newContent } );
    };
    const onChangeTitle = ( newTitle ) => {
        setAttributes( { title: newTitle } );
    };

    const onChangeAlignment = ( newAlignment ) => {
        setAttributes( {
            alignment: newAlignment === undefined ? 'none' : newAlignment,
        } );
    };

    const onChangeBGColor = ( hexColor ) => {
        setAttributes( { bg_color: hexColor } );
    };

    const onChangeTextColor = ( hexColor ) => {
        setAttributes( { text_color: hexColor } );
    };

    const onChangeContents = ( value ) => {
		setAttributes( { contents: value } );
        console.log("New richtest Value: ", value);
	};

    // const [ isOpen, setOpen ] = useState( false );
    // const openModal = () => setOpen( true );
    // const closeModal = () => setOpen( false );

    const [ isOpenLinkInspector, setLinkInspector ] = useState( false );
    const openLinkInspector = () => setLinkInspector( true );
    const closeLinkInspector = () => setLinkInspector( false );
    const toggleLinkInspector = () => {
		setLinkInspector( ( state ) => ! state );
	};

    let editorData =  useSelect( select => {    
        return select("core/block-editor") || select("core/editor");
    }, [] );

    let editorDispatch = useDispatch("core/editor");

    // console.log("editorDispatch: ", editorDispatch);
    // console.log("editorData: ", editorData);
    // console.log("getSelectedBlock ", editorData.getSelectedBlock());

    const addNewBlock = ()=>{
        const block = createBlock('alpha/info-box', {
            title:"The new Info box Content"
          });

        const afterInsert = editorDispatch.insertBlock(
                block
            );
    }

    const TestContent = ( { blockId, onClick } )=>{
        return (<div onClick={onClick} > The Content for test {blockId} </div>);
    }

    const TestContentDispatch = withDispatch( (dispatch, ownProps)=>{
        return {
            onClick:()=>{
                console.log("dispatch: ", dispatch("core"))
            }
        }
    } );

    const TestContentSelect = withSelect( (select, ownProps)=>{
        const { getSelectedBlockClientId } = select("core/editor")
        return {
            blockId:getSelectedBlockClientId()
        }
    } );

    const TestContentCompose = compose([TestContentSelect, TestContentDispatch])(TestContent);

	return (
		<div { ...useBlockProps() }>

            <GlobalInspector
            attributes ={attributes}
            setAttributes = {setAttributes}
            data = {inspectorsData}
            />


            <div className="bg-gray-100">
                <div className="container mx-auto text-black ">
                    <div role="article" className="bg-gray-100">
                        <div className="relative bg-white p-5 rounded-md h-full w-full">
                            <span>
                            <svg
                                xmlns="http://www.w3.org/2000/svg" className="icon-svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" strokeWidth="1.5">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            <RichText
                                className={attributes.titleClass}
                                style={ { textAlign: attributes.alignment } }
                                tagName="h1"
                                onChange={ onChangeTitle }
                                value={ attributes.title }
                            />  
                            <div className="my-5">
                        
                                <RichText
                                    tagName="div"
                                    multiline="div"
                                    className="text-content flex items-center pb-4 dark:border-gray-700 cursor-pointer w-full"
                                    placeholder={ __(
                                        'Write the contents…',
                                        'gutenberg-examples'
                                    ) }
                                    value={ contents }
                                    onChange={ onChangeContents }
                                />

                                                                
                            </div>

                            <div className='link-wrapper' onClick={toggleLinkInspector}>
                                <a className="hover:text-indigo-500 hover:underline absolute bottom-5 text-sm text-indigo-700 font-bold cursor-pointer flex items-center" href="#text">
                                    <p>Show All</p>
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" className="icon icon-tabler icon-tabler-arrow-narrow-right" width="16" height="16" viewBox="0 0 24 24" strokeWidth="1.5" stroke="#4338CA" fill="none" strokeLinecap="round" strokeLinejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <line x1="5" y1="12" x2="19" y2="12" />
                                            <line x1="15" y1="16" x2="19" y2="12" />
                                            <line x1="15" y1="8" x2="19" y2="12" />
                                        </svg>
                                    </div>
                                </a>                                        
                            </div>                                                                                                      
                        </div>                                
                    </div>
                </div>
            </div>	
		</div>
	);
}
