import { IconBase } from '@ant-design/icons-vue';

const CategoryIcon = (props) => {
  const svgElement = (
    <svg width="800px" height="800px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
    <title>category-list-solid</title>
    <g id="Layer_2" data-name="Layer 2">
        <g id="invisible_box" data-name="invisible box">
        <rect width="48" height="48" fill="none"/>
        </g>
        <g id="icons_Q2" data-name="icons Q2">
        <path d="M24,10h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,10Z"/>
        <path d="M24,24h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,24Z"/>
        <path d="M24,38h0a2,2,0,0,1,2-2H42a2,2,0,0,1,2,2h0a2,2,0,0,1-2,2H26A2,2,0,0,1,24,38Z"/>
        <path d="M12,2a2.1,2.1,0,0,0-1.7,1L4.2,13a2.3,2.3,0,0,0,0,2,1.9,1.9,0,0,0,1.7,1H18a2.1,2.1,0,0,0,1.7-1,1.8,1.8,0,0,0,0-2l-6-10A1.9,1.9,0,0,0,12,2Z"/>
        <path d="M12,30a6,6,0,1,1,6-6A6,6,0,0,1,12,30Z"/>
        <path d="M16,44H8a2,2,0,0,1-2-2V34a2,2,0,0,1,2-2h8a2,2,0,0,1,2,2v8A2,2,0,0,1,16,44Z"/>
        </g>
    </g>
    </svg>
  );
  return <IconBase {...props}>{svgElement}</IconBase>;
};

export default CategoryIcon;

