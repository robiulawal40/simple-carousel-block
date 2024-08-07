/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InnerBlocks, RichText } from '@wordpress/block-editor';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save({ attributes }) {

    const blockProps = useBlockProps.save();
// console.log("blockProps", blockProps);

	return (
		<div { ...useBlockProps.save() }>
			    <div className="w-full bg-gray-100">
            <div className="container mx-auto text-black ">
                <div role="article" className="bg-gray-100 py-12 md:px-8">
                    <div className="px-6 xl:px-0">
                        <div className="grid sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1 pb-6 gap-8">
                            <div role="cell" className="bg-gray-100">
                                <div className="relative bg-white p-5 rounded-md relative h-full w-full">
                                    <span><img className="bg-gray-200 p-2 mb-5 rounded-full ml-auto mr-auto " src="https://i.ibb.co/HFC1hqn/people-1.png" alt="home-1" /></span>
                                    <h1 className='pb-4 text-2xl font-semibold text-center'>{attributes.title}</h1>
                                    <div className="my-5">
                                        <div className="flex items-center pb-4 dark:border-gray-700 cursor-pointer w-full">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12.5" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </div>
                                            <p className="text-md text-gray-900 dark:text-gray-100 pl-4">First time, what do I do next?</p>
                                        </div>  
                                        <InnerBlocks.Content/>                          
                                    </div>
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
        </div>
		</div>
	);
}
